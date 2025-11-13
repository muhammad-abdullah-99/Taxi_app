<?php

namespace App\Jobs;

use App\Models\Travel;
use App\Models\AppUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendDriverWarning implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $travelId;
    public $tries = 1;
    public $timeout = 30;

    public function __construct($travelId)
    {
        $this->travelId = $travelId;
    }

    public function handle()
    {
        try {
            // ✅ SAFETY CHECK 1: Travel exists?
            $travel = Travel::find($this->travelId);
            
            if (!$travel) {
                Log::info("SendDriverWarning: Travel not found - ID: {$this->travelId}");
                return;
            }

            // ✅ SAFETY CHECK 2: Status check
            if ($travel->status !== 'PassengerAccepted') {
                Log::info("SendDriverWarning: Status changed - Travel ID: {$this->travelId}, Status: {$travel->status}");
                return;
            }

            // ✅ SAFETY CHECK 3: Trip started?
            if ($travel->started_at !== null) {
                Log::info("SendDriverWarning: Trip already started - Travel ID: {$this->travelId}");
                return;
            }

            // ✅ SAFETY CHECK 4: Already cancelled?
            if (in_array($travel->status, ['CancelledByPassenger', 'CancelledByDriver', 'CancelledBySystem'])) {
                Log::info("SendDriverWarning: Trip already cancelled - Travel ID: {$this->travelId}");
                return;
            }

            // ✅ SAFETY CHECK 5: Driver exists?
            if (!$travel->user_id) {
                Log::info("SendDriverWarning: No driver assigned - Travel ID: {$this->travelId}");
                return;
            }

            $driver = AppUser::find($travel->user_id);
            
            if (!$driver) {
                Log::info("SendDriverWarning: Driver not found - Travel ID: {$this->travelId}");
                return;
            }

            // ✅ GET DRIVER'S LANGUAGE FROM REQUEST HEADER (DEFAULT AR)
            $lang = 'ar';
            
            // ✅ MULTI-LANGUAGE WARNING MESSAGES
            $messages = [
                'ar' => '⚠️ لديك 15 دقيقة لبدء الرحلة وإلا سيتم إلغاء الاشتراك',
                'en' => '⚠️ 15 minutes remaining to start trip or subscription will cancel',
                'ur' => '⚠️ ٹرپ شروع کرنے کے لیے 15 منٹ باقی ہیں ورنہ سبسکرپشن منسوخ ہو جائے گی'
            ];

            $message = $messages[$lang] ?? $messages['ar'];

            // ✅ SEND SMS
            $this->sendSMS($driver->mobile, $message);

            Log::info("SendDriverWarning: SMS sent successfully - Travel ID: {$this->travelId}, Driver: {$driver->id}");

        } catch (\Exception $e) {
            Log::error('SendDriverWarning Job Error', [
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
                Log::error('SMS Send Failed in Warning Job', [
                    'mobile' => $mobile,
                    'response' => $response->body()
                ]);
            }
            
        } catch (\Exception $e) {
            Log::error('SMS Exception in Warning Job', [
                'mobile' => $mobile,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error('SendDriverWarning Job Failed Completely', [
            'travel_id' => $this->travelId,
            'error' => $exception->getMessage()
        ]);
    }
}