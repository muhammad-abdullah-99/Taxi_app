<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Support\Facades\Cache;

class PaymentSecurityService
{

    public function checkWalletSecurity($userId)
    {
        $wallet = Wallet::where('user_id', $userId)->first();

        if (!$wallet) {
            return ['allowed' => false, 'reason' => 'Wallet not found'];
        }

        if ($wallet->is_locked) {
            return ['allowed' => false, 'reason' => $wallet->locked_reason ?? 'Wallet is locked'];
        }

        if ($wallet->daily_reset_date != now()->toDateString()) {
            $wallet->update([
                'daily_spent' => 0,
                'daily_reset_date' => now()->toDateString()
            ]);
        }

        return ['allowed' => true, 'wallet' => $wallet];
    }

    public function checkDailyLimit($wallet, $amount)
    {
        $newTotal = $wallet->daily_spent + $amount;
        return $newTotal <= $wallet->daily_limit;
    }

    public function sanitizePaymentData($data)
    {
        $sanitized = $data;
        $sensitiveFields = ['cvc', 'cvv', 'password', 'pin', 'number'];
        
        foreach ($sensitiveFields as $field) {
            if (isset($sanitized[$field])) {
                $sanitized[$field] = '***REDACTED***';
            }
        }

        return $sanitized;
    }

    public function logFailedAttempt($userId, $reason)
    {
        $wallet = Wallet::where('user_id', $userId)->first();
        if ($wallet) {
            $wallet->increment('failed_attempts');
            if ($wallet->failed_attempts >= 5) {
                $wallet->update([
                    'is_locked' => true,
                    'locked_at' => now(),
                    'locked_reason' => 'Multiple failed transaction attempts'
                ]);
            }
        }
        \Log::error('Payment Failed', ['user_id' => $userId, 'reason' => $reason]);
    }
}
