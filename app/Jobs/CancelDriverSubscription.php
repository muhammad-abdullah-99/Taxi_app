<?php

namespace App\Jobs;

use App\Models\Travel;
use App\Models\AppUser;
use App\Models\Subscription;
use App\Models\PackageType;
use App\Models\Wallet;
use App\Models\WalletDetail;
use App\Models\StationWallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CancelDriverSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $travelId;
    public $tries = 1;
    public $timeout = 60;

    public function __construct($travelId)
    {
        $this->travelId = $travelId;
    }

    public function handle()
    {
        DB::beginTransaction();
        
        try {
            // ✅ SAFETY CHECK 1: Travel exists?
            $travel = Travel::find($this->travelId);
            
            if (!$travel) {
                Log::info("CancelSubscription: Travel not found - ID: {$this->travelId}");
                DB::rollBack();
                return;
            }

            // ✅ SAFETY CHECK 2: Status check
            if ($travel->status !== 'PassengerAccepted') {
                Log::info("CancelSubscription: Status changed - Travel ID: {$this->travelId}, Status: {$travel->status}");
                DB::rollBack();
                return;
            }

            // ✅ SAFETY CHECK 3: Trip started?
            if ($travel->started_at !== null) {
                Log::info("CancelSubscription: Trip already started - Travel ID: {$this->travelId}");
                DB::rollBack();
                return;
            }

            // ✅ SAFETY CHECK 4: Already cancelled?
            if (in_array($travel->status, ['CancelledByPassenger', 'CancelledByDriver', 'CancelledBySystem'])) {
                Log::info("CancelSubscription: Already cancelled - Travel ID: {$this->travelId}");
                DB::rollBack();
                return;
            }

            // ✅ SAFETY CHECK 5: Driver exists?
            if (!$travel->user_id) {
                Log::info("CancelSubscription: No driver assigned - Travel ID: {$this->travelId}");
                DB::rollBack();
                return;
            }

            $driverId = $travel->user_id;
            $driver = AppUser::find($driverId);
            
            if (!$driver) {
                Log::info("CancelSubscription: Driver not found - Travel ID: {$this->travelId}");
                DB::rollBack();
                return;
            }

            // ✅ SAFETY CHECK 6: Client exists?
            if (!$travel->client_id) {
                Log::warning("CancelSubscription: No client found - Travel ID: {$this->travelId}");
                DB::rollBack();
                return;
            }

            $lang = 'ar';

            // ===================================
            // ACTION 1: DEACTIVATE SUBSCRIPTION
            // ===================================
            $intercityPackage = PackageType::where('name', 'بين المدن')->first();
            
            if ($intercityPackage) {
                $activeSubscriptions = Subscription::where('user_id', $driverId)
                    ->where('package_id', $intercityPackage->id)
                    ->where('status', 'active')
                    ->get();

                foreach ($activeSubscriptions as $subscription) {
                    $subscription->update([
                        'status' => 'inactive',
                        'updated_at' => now()
                    ]);
                    
                    Log::info("Subscription deactivated", [
                        'subscription_id' => $subscription->id,
                        'driver_id' => $driverId,
                        'travel_id' => $this->travelId
                    ]);
                }
            }

            // ===================================
            // ACTION 2: CANCEL TRIP
            // ===================================
            $travel->update([
                'status' => 'CancelledBySystem',
                'cancelled_at' => \Carbon\Carbon::now('Asia/Riyadh')
            ]);

            // ===================================
            // ACTION 3: UPDATE STATION WALLET
            // ===================================
            $stationWallet = StationWallet::where('travel_id', $this->travelId)->first();
            
            if ($stationWallet) {
                $stationWallet->update([
                    'client_status' => 'refunded',
                    'driver_status' => 'cancelled',
                    'payment_status' => 'cancelled'
                ]);
            }

            // ===================================
            // ACTION 4: REFUND PASSENGER 100%
            // ===================================
            $wallet = Wallet::where('user_id', $travel->client_id)->first();
            
            if (!$wallet) {
                Log::warning("CancelSubscription: Passenger wallet not found - Creating new", [
                    'client_id' => $travel->client_id,
                    'travel_id' => $this->travelId
                ]);
                
                $wallet = Wallet::create([
                    'user_id' => $travel->client_id,
                    'current_balance' => 0,
                    'total_recharge' => 0
                ]);
            }

            // ✅ SAFETY CHECK: No duplicate refund
            $existingRefund = WalletDetail::where('travel_id', $this->travelId)
                ->whereNotNull('refund_amount')
                ->exists();
            
            if ($existingRefund) {
                Log::warning("CancelSubscription: Refund already exists - Skipping", [
                    'travel_id' => $this->travelId
                ]);
                DB::rollBack();
                return;
            }

            // ✅ ADD REFUND TO WALLET
            $refundAmount = $travel->amount;
            $wallet->current_balance += $refundAmount;
            $wallet->save();

            // ✅ GET PASSENGER'S LANGUAGE (DEFAULT AR)
            $passenger = AppUser::find($travel->client_id);
            $passengerLang = 'ar';

            // ✅ MULTI-LANGUAGE REFUND MESSAGES
            $refundNames = [
                'ar' => 'استرداد النظام',
                'en' => 'System Refund',
                'ur' => 'سسٹم ریفنڈ'
            ];

            $refundDetails = [
                'ar' => 'السائق لم يبدأ الرحلة - استرداد كامل من ' . $travel->from . ' إلى ' . $travel->to,
                'en' => 'Driver did not start trip - Full refund from ' . $travel->from . ' to ' . $travel->to,
                'ur' => 'ڈرائیور نے ٹرپ شروع نہیں کیا - مکمل رقم واپسی ' . $travel->from . ' سے ' . $travel->to . ' تک'
            ];

            // ✅ CREATE WALLET DETAIL
            WalletDetail::create([
                'name' => $refundNames[$passengerLang] ?? $refundNames['ar'],
                'wallet_id' => $wallet->id,
                'amount' => $refundAmount,
                'refund_amount' => $refundAmount,
                'deduction_amount' => 0,
                'refund_percentage' => 100,
                'details' => $refundDetails[$passengerLang] ?? $refundDetails['ar'],
                'travel_id' => $this->travelId,
                'transaction_date' => now()
            ]);

            Log::info("Refund processed successfully", [
                'travel_id' => $this->travelId,
                'passenger_id' => $travel->client_id,
                'amount' => $refundAmount
            ]);

            // ===================================
            // ACTION 5: SEND SMS TO DRIVER
            // ===================================
            $driverMessages = [
                'ar' => '❌ تم إلغاء الاشتراك لعدم بدء الرحلة. يرجى التجديد لقبول رحلات جديدة',
                'en' => '❌ Subscription cancelled for not starting trip. Renew to accept new trips',
                'ur' => '❌ ٹرپ شروع نہ کرنے کی وجہ سے سبسکرپشن منسوخ ہو گئی۔ نئے ٹرپس کے لیے تجدید کریں'
            ];

            $this->sendSMS($driver->mobile, $driverMessages[$lang] ?? $driverMessages['ar']);

            DB::commit();

            Log::info("CancelDriverSubscription: Completed successfully", [
                'travel_id' => $this->travelId,
                'driver_id' => $driverId,
                'refund_amount' => $refundAmount
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('CancelDriverSubscription Job Error', [
                'travel_id' => $this->travelId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function sendSMS($mobile, $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$mobile],
                'body' => $message,
            ]);
            
            if (!$response->successful()) {
                Log::error('SMS Send Failed in Cancellation Job', [
                    'mobile' => $mobile,
                    'response' => $response->body()
                ]);
            }
            
        } catch (\Exception $e) {
            Log::error('SMS Exception in Cancellation Job', [
                'mobile' => $mobile,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error('CancelDriverSubscription Job Failed Completely', [
            'travel_id' => $this->travelId,
            'error' => $exception->getMessage()
        ]);
    }
}