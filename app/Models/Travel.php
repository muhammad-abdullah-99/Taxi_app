<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;
use App\Models\WalletDetail;

class Travel extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'round_trip' => 'boolean'
    ];
    
    protected static function booted()
    {
        // ✅ AUTOMATIC - Jab travel create ho (booking time)
        static::created(function ($travel) {
            if ($travel->client_id && $travel->amount > 0) {
                $clientWallet = Wallet::where('user_id', $travel->client_id)->first();
                if ($clientWallet) {
                    WalletDetail::create([
                        'wallet_id' => $clientWallet->id,
                        'travel_id' => $travel->id,
                        'name' => 'Payment Hold',
                        'amount' => -$travel->amount,
                        'details' => 'رحلة من ' . $travel->from . ' إلى ' . $travel->to,
                        'transaction_date' => now()->toDateString() // ✅ ADD THIS LINE
                    ]);
                }
            }
        });
    }

    public function appUser()
    {
        return $this->belongsTo(AppUser::class,'user_id');
    }
    
    public function client()
    {
        return $this->belongsTo(AppUser::class,'client_id');
    }
    
    public function between_city()
    {
        return $this->belongsTo(BetweenCity::class,'between_city_id');
    }
}