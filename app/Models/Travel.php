<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;
use App\Models\WalletDetail;

class Travel extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'date',
        'amount',
        'time',
        'status',
        'user_id',
        'client_id',
        'passengers',
        'between_city_id',
        'selected_transport_type',
        'latitude_from',
        'longitude_from',
        'latitude_to',
        'longitude_to',
        'round_trip',
        'started_at',      // ✅ ADD - Trip start timestamp
        'ended_at',        // ✅ ADD - Trip end timestamp
        'driver_assigned_at',
        'cancelled_at',
        'return_date', 
        'return_time'
    ];

    // ✅ CHANGE 2: Add datetime casts for new fields
    protected $casts = [
        'round_trip' => 'boolean',
        'started_at' => 'datetime',   // ✅ ADD
        'ended_at' => 'datetime',     // ✅ ADD
        'driver_assigned_at' => 'datetime',   // ✅ ADD
        'cancelled_at' => 'datetime',     // ✅ ADD        
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

    // ✅ ADD THIS RELATIONSHIP
    public function stationWallet()
    {
        return $this->hasOne(StationWallet::class, 'travel_id');
    }

    // ✅ Accessor for transport_types
    public function getTransportTypesAttribute()
    {
        if ($this->between_city) {
            return $this->between_city->transport_types_arabic;
        }
        return [];
    }

    // ✅ Accessor for transport_types raw data
    public function getTransportTypesRawAttribute()
    {
        if ($this->between_city) {
            return $this->between_city->transport_types;
        }
        return null;
    }    

    // ✅ NEW: Accessor for selected transport type Arabic name
    public function getSelectedTransportTypeArabicAttribute()
    {
        if ($this->selected_transport_type && $this->between_city) {
            $transportTypes = BetweenCity::TRANSPORT_TYPES;
            return $transportTypes[$this->selected_transport_type] ?? $this->selected_transport_type;
        }
        return null;
    }

    // ✅ NEW: Accessor for display (English + Arabic)
    public function getDisplaySelectedTransportTypeAttribute()
    {
        if ($this->selected_transport_type && $this->selected_transport_type_arabic) {
            return $this->selected_transport_type . ' - ' . $this->selected_transport_type_arabic;
        }
        return $this->selected_transport_type;
    }

}