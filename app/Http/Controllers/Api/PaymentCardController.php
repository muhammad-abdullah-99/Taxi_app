<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SavedCard;
use App\Models\Wallet;
use App\Models\WalletDetail;
use App\Services\PaymentSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PaymentCardController extends Controller
{
    protected $securityService;
    // protected $logService;

    public function __construct()
    {
        $this->securityService = new PaymentSecurityService();
        // $this->logService = new PaymentLogService();
    }

    public function saveCard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|exists:app_users,id',
            'name' => 'required|string',
            'number' => 'required|string|size:16',
            'cvc' => 'required|string|size:3',
            'month' => 'required|string|size:2',
            'year' => 'required|string|size:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $securityCheck = $this->securityService->checkWalletSecurity($request->user_id);
            if (!$securityCheck['allowed']) {
                return response()->json(['success' => false, 'message' => $securityCheck['reason']], 403);
            }

            // Solving the Moyasar card timout issue
            $maxRetries = 2;
            $lastResponse = null;

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = Http::timeout(45) // ✅ 45 seconds timeout
                    ->withBasicAuth(env('MOYASAR_API_KEY'), '')
                    ->post('https://api.moyasar.com/v1/tokens', [
                        'name' => $request->name,
                        'number' => $request->number,
                        'cvc' => $request->cvc,
                        'month' => $request->month,
                        'year' => $request->year,
                    ]);

                $lastResponse = $response;
                
                if ($response->successful()) {
                    break; // ✅ Success, break out of retry loop
                }
                
                \Log::warning("Moyasar tokenization attempt {$attempt} failed", [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                
                if ($attempt < $maxRetries) {
                    sleep(1); // ✅ Wait before retry
                }
                
            } catch (\Exception $e) {
                \Log::warning("Moyasar tokenization attempt {$attempt} exception", [
                    'error' => $e->getMessage()
                ]);
                
                if ($attempt === $maxRetries) {
                    throw $e; // ✅ Last attempt, throw exception
                }
                sleep(1); // ✅ Wait before retry
            }
        }

        // ✅ PURANE CODE KI JAGAH YEH USE KARO
        if ($lastResponse->failed()) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Card tokenization failed after retries'], 400);
        }            

            $tokenData = $lastResponse->json();

            $existingCard = SavedCard::where('user_id', $request->user_id)
                ->where('fingerprint', $tokenData['fingerprint'] ?? null)
                ->first();

            if ($existingCard) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Card already saved'], 409);
            }

            $savedCard = SavedCard::create([
                'user_id' => $request->user_id,
                'moyasar_token' => $tokenData['id'],
                'card_brand' => strtolower($tokenData['brand']),
                'last_four' => substr($request->number, -4),
                'exp_month' => $request->month,
                'exp_year' => $request->year,
                'card_holder_name' => $request->name,
                'fingerprint' => $tokenData['fingerprint'] ?? null,
                'is_default' => $request->set_as_default ?? false,
            ]);

            if ($request->set_as_default) {
                $savedCard->markAsDefault();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Card saved successfully',
                'card' => [
                    'id' => $savedCard->id,
                    'display_name' => $savedCard->display_name,
                    'is_default' => $savedCard->is_default
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Save Card Error', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error saving card'], 500);
        }
    }

public function chargeWithSavedCard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|exists:app_users,id',
            'card_id' => 'required|exists:saved_cards,id',
            'amount' => 'required|numeric|min:10|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $savedCard = SavedCard::where('id', $request->card_id)
                ->where('user_id', $request->user_id)
                ->where('is_active', true)
                ->first();

            if (!$savedCard) {
                return response()->json(['success' => false, 'message' => 'Card not available'], 404);
            }

            // Token safety check
            $token = $savedCard->moyasar_token;
            if (!$token) {
                \Log::error('Saved card token decryption failed or empty', [
                    'card_id' => $savedCard->id,
                    'user_id' => $savedCard->user_id
                ]);
                return response()->json(['success' => false, 'message' => 'Card data corrupted. Please re-add your card.'], 400);
            }

            if ($savedCard->isExpired()) {
                return response()->json(['success' => false, 'message' => 'Card not available'], 404);
            }

            $securityCheck = $this->securityService->checkWalletSecurity($request->user_id);
            if (!$securityCheck['allowed']) {
                return response()->json(['success' => false, 'message' => $securityCheck['reason']], 403);
            }

            $wallet = $securityCheck['wallet'];
            if (!$this->securityService->checkDailyLimit($wallet, $request->amount)) {
                return response()->json(['success' => false, 'message' => 'Daily limit exceeded'], 403);
            }

            // Moyasar payment with retry logic
            $maxRetries = 2;
            $lastResponse = null;
            
            for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
                try {
                    $response = Http::timeout(60)
                        ->withBasicAuth(env('MOYASAR_API_KEY'), '')
                        ->post('https://api.moyasar.com/v1/payments', [
                            'amount' => $request->amount * 100,
                            'currency' => 'SAR',
                            'description' => 'شحن محفظة عبر بطاقة محفوظة',
                            'callback_url' => url('api/wallets/charge/callback'),
                            'metadata' => [
                                'user_id' => $request->user_id,
                                'card_id' => $savedCard->id
                            ],
                            'source' => [
                                'type' => 'token',
                                'token' => $savedCard->moyasar_token
                            ]
                        ]);

                    $lastResponse = $response;
                    
                    if ($response->successful()) {
                        break;
                    }
                    
                    \Log::warning("Moyasar payment attempt {$attempt} failed", [
                        'status' => $response->status(),
                        'user_id' => $request->user_id,
                        'amount' => $request->amount
                    ]);
                    
                    if ($attempt < $maxRetries) {
                        sleep(2);
                    }
                    
                } catch (\Exception $e) {
                    \Log::warning("Moyasar payment attempt {$attempt} exception", [
                        'error' => $e->getMessage(),
                        'user_id' => $request->user_id
                    ]);
                    
                    if ($attempt === $maxRetries) {
                        throw $e;
                    }
                    sleep(2);
                }
            }

            if ($lastResponse->successful()) {
                $payment = $lastResponse->json();
                $savedCard->recordUsage();

                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Payment initiated',
                    'payment_url' => $payment['source']['transaction_url'] ?? null
                ]);
            }

            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Payment failed'], 400);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Saved Card Payment Error', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Payment error'], 500);
        }
    }

    public function getSavedCards($userId)
    {
        $cards = SavedCard::where('user_id', $userId)
            ->where('is_active', true)
            ->orderBy('is_default', 'desc')
            ->get()
            ->map(function ($card) {
                return [
                    'id' => $card->id,
                    'display_name' => $card->display_name,
                    'brand' => $card->card_brand,
                    'last_four' => $card->last_four,
                    'exp_month' => $card->exp_month,
                    'exp_year' => $card->exp_year,
                    'is_default' => $card->is_default,
                    'is_expired' => $card->isExpired(),
                ];
            });

        return response()->json(['success' => true, 'cards' => $cards]);
    }

    public function deleteCard(Request $request, $cardId)
    {
        $card = SavedCard::where('id', $cardId)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$card) {
            return response()->json(['success' => false, 'message' => 'Card not found'], 404);
        }

        $card->delete();
        return response()->json(['success' => true, 'message' => 'Card deleted']);
    }

    public function setDefaultCard(Request $request, $cardId)
    {
        $card = SavedCard::where('id', $cardId)
            ->where('user_id', $request->user_id)
            ->where('is_active', true)
            ->first();

        if (!$card) {
            return response()->json(['success' => false, 'message' => 'Card not found'], 404);
        }

        $card->markAsDefault();
        return response()->json(['success' => true, 'message' => 'Default card updated']);
    }
}
