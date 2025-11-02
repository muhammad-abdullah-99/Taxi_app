<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;
use App\Models\WalletDetail;

class StationWallet extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected static function booted()
    {
        // ✅ AUTOMATIC - Jab payment status change ho
        static::updated(function ($stationWallet) {
            // Payment released to driver
            if ($stationWallet->isDirty('payment_status') && 
                $stationWallet->payment_status === 'released') {
                
                $travel = $stationWallet->travel;
                if ($travel && $travel->user_id) {
                    $driverWallet = Wallet::where('user_id', $travel->user_id)->first();
                    if ($driverWallet) {
                        // ✅ CHECK: Pehle se record exist nahi karta
                        $exists = WalletDetail::where('travel_id', $travel->id)
                            ->where('wallet_id', $driverWallet->id)
                            ->where('name', 'Payment Received')
                            ->exists();
                        
                        if (!$exists) {
                            WalletDetail::create([
                                'wallet_id' => $driverWallet->id,
                                'travel_id' => $travel->id,
                                'name' => 'Payment Received',
                                'amount' => $stationWallet->amount,
                                'details' => 'رحلة من ' . $travel->from . ' إلى ' . $travel->to,
                                'transaction_date' => now()->toDateString()
                            ]);
                        }
                    }
                }
            }
            
            // ✅ CRITICAL FIX: CANCELLATION KE LIYE YE BLOCK DISABLE KARO
            // Kyunki TravelController mein already refund logic hai with percentage calculation
            // Yahan se sirf duplicate entry ban rahi thi
            
            // COMMENT OUT YA DELETE KARO:
            /*
            if ($stationWallet->isDirty('payment_status') && 
                $stationWallet->payment_status === 'cancelled') {
                
                $travel = $stationWallet->travel;
                if ($travel && $travel->client_id) {
                    $clientWallet = Wallet::where('user_id', $travel->client_id)->first();
                    if ($clientWallet) {
                        WalletDetail::create([
                            'wallet_id' => $clientWallet->id,
                            'travel_id' => $travel->id,
                            'name' => 'Payment Refund',
                            'amount' => $stationWallet->amount,
                            'details' => 'إلغاء رحلة من ' . $travel->from . ' إلى ' . $travel->to,
                            'transaction_date' => now()->toDateString()
                        ]);
                    }
                }
            }
            */
        });
    }
    
    public function travel()
    {
        return $this->belongsTo(Travel::class,'travel_id');
    }
}