<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Geha;
use App\Models\Snd;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    // دالة لجلب بيانات المحفظة
    public function getWallet($userId)
    {
        $wallet = Wallet::where('user_id', $userId)->with('details')->first();

        if (!$wallet) {
            return response()->json(['message' => 'Wallet not found'], 404);
        }

        return response()->json($wallet);
    }

    // دالة لتحديث الرصيد
    public function updateWallet(Request $request, $userId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $userId) {
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $userId],
                ['current_balance' => 0, 'total_recharge' => 0]
            );

            $wallet->increment('current_balance', $request->amount);
            $wallet->increment('total_recharge', $request->amount);
            $wallet->save();
        });

        return response()->json(['message' => 'Wallet updated successfully']);
    }

    public function index()
    {
        $wallets = Wallet::whereHas('user', function ($query) {
            $query->where('user_type', 'Driver')
                ->where('status', 1)
                ->where('name', '!=', 'guest');
        })->get();
        $drivers = AppUser::where('user_type', 'Driver')->where('status', 1)->where('name', '!=', 'guest')->get();
        return view('admin.transport.wallet.wallet', compact(['wallets', 'drivers']));
    }

    
    public function walletClient()
    {
        $wallets = Wallet::whereHas('user', function ($query) {
            $query->where('user_type', 'Passenger')
                ->where('status', 1)
                ->where('name', '!=', 'guest');
        })->get();
        $drivers = AppUser::where('user_type', 'Passenger')->where('status', 1)->where('name', '!=', 'guest')->get();
        return view('admin.transport.wallet.client', compact(['wallets', 'drivers']));
    }

// ========================================
// 🔧 FIX #1: ADD SECURITY TO OLD METHOD
// ========================================
public function chargeOnline(Request $request)
{
    $request->validate([
        'driver_id' => 'required',
        'amount' => 'required|numeric|min:0.01',
        'name' => 'required|string',
        'number' => 'required|string',
        'cvc' => 'required|string',
        'month' => 'required|string',
        'year' => 'required|string',
    ]);

    // ✅ ADD: Security check
    $securityService = new \App\Services\PaymentSecurityService();
    $securityCheck = $securityService->checkWalletSecurity($request->driver_id);
    
    if (!$securityCheck['allowed']) {
        return redirect()->back()->with('error', $securityCheck['reason']);
    }
    
    if (!$securityService->checkDailyLimit($securityCheck['wallet'], $request->amount)) {
        return redirect()->back()->with('error', 'تجاوزت الحد اليومي للمعاملات');
    }

    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->post('https://api.moyasar.com/v1/payments', [
            'amount' => $request->amount * 100,
            'currency' => 'SAR',
            'description' => 'شحن رصيد للسائق',
            'callback_url' => url('wallet/charge/callback'),
            'metadata' => [
                'driver_id' => $request->driver_id,
                'client_type' => 'جهة',
                'client_id' => Geha::where('name', 'تطبيق روز تاكسي')->value('id'),
                'type' => 'قبض',
                'payment_method' => 'بوابة الدفع',
                'tax' => 'غير خاضع للضريبة',
                'description' => 'شحن رصيد عبر بوابة ميسر',
                'date' => now()->toDateString(),
            ],
            'source' => [
                'type' => 'creditcard',
                'name' => $request->name,
                'number' => $request->number,
                'cvc' => $request->cvc,
                'month' => $request->month,
                'year' => $request->year,
            ]
        ]);

    if ($response->successful()) {
        $payment = $response->json();
        return redirect($payment['source']['transaction_url']);
    }

    // ✅ ADD: Log failed attempt
    $securityService->logFailedAttempt($request->driver_id, 'Payment gateway rejected');
    return redirect()->back()->with('error', '❌ فشل إرسال الطلب إلى بوابة الدفع.');
}

// ========================================
// 🔧 FIX #2: UPDATE DAILY_SPENT IN CALLBACK
// ========================================
public function chargeCallback(Request $request)
{
    $paymentId = $request->get('id');
    if (!$paymentId) {
        return redirect()->route('showTransportBox')->with('error', '❌ معرف العملية غير موجود.');
    }

    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

    if ($response->failed()) {
        return redirect()->route('showTransportBox')->with('error', '❌ فشل التحقق من الدفع.');
    }

    $payment = $response->json();
    if ($payment['status'] !== 'paid') {
        return redirect()->route('showTransportBox')->with('error', '❌ الدفع لم يكتمل. الحالة: ' . $payment['status']);
    }

    $amount = $payment['amount'] / 100;
    $meta = $payment['metadata'];

    DB::transaction(function () use ($meta, $amount) {
        // 1. إنشاء السند
        $snd = new Snd();
        $snd->type = $meta['type'] ?? 'قبض';
        $snd->payment_method = $meta['payment_method'] ?? 'بوابة الدفع';
        $snd->bank_account = null;
        $snd->amount = $amount;
        $snd->tax = $meta['tax'] ?? 'غير خاضع للضريبة';
        $snd->description = $meta['description'] ?? 'دفع عبر بوابة ميسر';
        $snd->date = $meta['date'] ?? now();
        $snd->client_type = $meta['client_type'];
        $snd->geha_id = $meta['client_id'];
        $snd->save();

        // 2. تحديث رصيد المحفظة
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $meta['driver_id']],
            ['current_balance' => 0]
        );

        $wallet->current_balance += $amount;
        // ✅ FIX: INCREMENT DAILY_SPENT
        $wallet->daily_spent += $amount;
        $wallet->save();

        // ✅ FIX: RESET FAILED ATTEMPTS ON SUCCESS
        if ($wallet->failed_attempts > 0) {
            $wallet->update([
                'failed_attempts' => 0,
                'is_locked' => false,
                'locked_at' => null,
                'locked_reason' => null
            ]);
        }

        // 3. إضافة تفاصيل المعاملة
        $wallet->details()->create([
            'name' => 'قبض',
            'amount' => $amount,
            'details' => 'شحن رصيد عن طريق بوابة الدفع',
        ]);
    });

    return redirect()->route('showTransportBox')->with('success', '✅ تم الدفع وشحن الرصيد بنجاح.');
}


public function chargeOnlineSecure(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'user_id' => 'required|exists:app_users,id',
        'amount' => 'required|numeric|min:10|max:5000',
        'name' => 'required|string',
        'number' => 'required|string|size:16',
        'cvc' => 'required|string|size:3',
        'month' => 'required|string|size:2',
        'year' => 'required|string|size:4',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
    }

    // ✅ Security checks
    $securityService = new \App\Services\PaymentSecurityService();
    $securityCheck = $securityService->checkWalletSecurity($request->user_id);
    
    if (!$securityCheck['allowed']) {
        return response()->json(['success' => false, 'message' => $securityCheck['reason']], 403);
    }

    $wallet = $securityCheck['wallet'];
    
    if (!$securityService->checkDailyLimit($wallet, $request->amount)) {
        return response()->json(['success' => false, 'message' => 'Daily limit exceeded'], 403);
    }

    // ✅ Use existing Moyasar integration
    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->post('https://api.moyasar.com/v1/payments', [
            'amount' => $request->amount * 100,
            'currency' => 'SAR',
            'description' => 'شحن رصيد للسائق',
            'callback_url' => url('api/wallet/charge/callback/secure'),
            'metadata' => [
                'driver_id' => $request->user_id,
                'client_type' => 'جهة',
                'client_id' => \App\Models\Geha::where('name', 'تطبيق روز تاكسي')->value('id'),
                'type' => 'قبض',
                'payment_method' => 'بوابة الدفع',
                'tax' => 'غير خاضع للضريبة',
                'description' => 'شحن رصيد عبر بوابة ميسر',
                'date' => now()->toDateString(),
            ],
            'source' => [
                'type' => 'creditcard',
                'name' => $request->name,
                'number' => $request->number,
                'cvc' => $request->cvc,
                'month' => $request->month,
                'year' => $request->year,
            ]
        ]);

    if ($response->successful()) {
        $payment = $response->json();
        
        return response()->json([
            'success' => true,
            'message' => 'Payment initiated',
            'redirect_url' => $payment['source']['transaction_url']
        ]);
    }

    $securityService->logFailedAttempt($request->user_id, 'Payment gateway rejected');

    return response()->json(['success' => false, 'message' => '❌ فشل إرسال الطلب'], 400);
}

// =================================================
// 🔧 FIX: UPDATE DAILY_SPENT IN SECURE CALLBACK
// =================================================
public function chargeCallbackSecure(Request $request)
{
    $paymentId = $request->get('id');
    if (!$paymentId) {
        return redirect()->route('showTransportBox')->with('error', '❌ معرف العملية غير موجود.');
    }

    DB::beginTransaction();
    try {
        $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if ($response->failed()) {
            DB::rollBack();
            return redirect()->route('showTransportBox')->with('error', '❌ فشل التحقق من الدفع.');
        }

        $payment = $response->json();

        if ($payment['status'] !== 'paid') {
            DB::rollBack();
            return redirect()->route('showTransportBox')->with('error', '❌ الدفع لم يكتمل.');
        }

        $amount = $payment['amount'] / 100;
        $meta = $payment['metadata'];

        // ✅ Update wallet
        $wallet = Wallet::where('user_id', $meta['driver_id'])->lockForUpdate()->first();
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => $meta['driver_id'],
                'current_balance' => 0,
                'total_recharge' => 0
            ]);
        }

        $wallet->current_balance += $amount;
        // ✅ FIX: INCREMENT DAILY_SPENT
        $wallet->daily_spent += $amount;
        $wallet->save();

        // ✅ FIX: RESET FAILED ATTEMPTS ON SUCCESS
        if ($wallet->failed_attempts > 0) {
            $wallet->update([
                'failed_attempts' => 0,
                'is_locked' => false,
                'locked_at' => null,
                'locked_reason' => null
            ]);
        }

        $wallet->details()->create([
            'name' => 'قبض',
            'amount' => $amount,
            'details' => 'شحن رصيد عن طريق بوابة الدفع',
            'transaction_date' => now()->toDateString()
        ]);

        // ✅ Create Snd (existing system)
        $snd = new \App\Models\Snd();
        $snd->type = $meta['type'] ?? 'قبض';
        $snd->payment_method = $meta['payment_method'] ?? 'بوابة الدفع';
        $snd->bank_account = null;
        $snd->amount = $amount;
        $snd->tax = $meta['tax'] ?? 'غير خاضع للضريبة';
        $snd->description = $meta['description'] ?? 'دفع عبر بوابة ميسر';
        $snd->date = $meta['date'] ?? now();
        $snd->client_type = $meta['client_type'];
        $snd->geha_id = $meta['client_id'];
        $snd->save();

        DB::commit();

        // ✅ SMS NON-BLOCKING
        $user = \App\Models\AppUser::find($meta['driver_id']);
        if ($user && $user->mobile) {
            $this->sendNonBlockingSms(
                $user->mobile,
                "تم شحن محفظتك بنجاح بمبلغ {$amount} ريال.\nرقم العملية: {$paymentId}\nالرصيد الحالي: {$wallet->current_balance} ريال",
                $user->id,
                $amount
            );
        }

        return redirect()->route('showTransportBox')->with('success', '✅ تم الدفع وشحن الرصيد بنجاح.');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Callback Error', ['error' => $e->getMessage()]);
        return redirect()->route('showTransportBox')->with('error', '❌ حدث خطأ');
    }
}


    public function showWalletDetails($wallet_id)
    {
        $wallet = Wallet::with('details')->findOrFail($wallet_id);

        return view('admin.transport.wallet.details', compact('wallet'));
    }


/**
 * ✅ NON-BLOCKING SMS FUNCTION - Simple & Professional
 */
private function sendNonBlockingSms($mobile, $message, $userId = null, $amount = null)
{
    try {
        Http::timeout(5)
            ->withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$mobile],
                'body' => $message
            ]);

        \Log::info('SMS sent successfully', [
            'user_id' => $userId,
            'mobile' => $mobile,
            'amount' => $amount
        ]);

    } catch (\Exception $e) {
        \Log::warning('SMS sending failed but transaction completed', [
            'user_id' => $userId,
            'mobile' => $mobile,
            'error' => $e->getMessage()
        ]);
    }
}

}