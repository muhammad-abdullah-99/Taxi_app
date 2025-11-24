<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverPayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payment_id',
        'travel_id',
        'driver_id',
        'passenger_id',
        'trip_amount',
        'operating_fee',
        'driver_amount',
        'status',
        'admin_reference',
        'admin_notes',
        'marked_by',
        'trip_completed_at',
        'paid_at'
    ];

    protected $casts = [
        'trip_amount' => 'decimal:2',
        'operating_fee' => 'decimal:2',
        'driver_amount' => 'decimal:2',
        'trip_completed_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    // Generate unique payment ID
    public static function generatePaymentId()
    {
        return 'PAY-' . strtoupper(uniqid()) . '-' . time();
    }

    // Relationships
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function driver()
    {
        return $this->belongsTo(AppUser::class, 'driver_id');
    }

    public function passenger()
    {
        return $this->belongsTo(AppUser::class, 'passenger_id');
    }

    public function markedByAdmin()
    {
        return $this->belongsTo(\App\Models\User::class, 'marked_by');
    }
}