<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'travel_id', 
        'amount',
        'type',
        'status',
        'title',
        'description',
        'package_type',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travel_id');
    }

    // Package Type Accessor
    public function getPackageTypeNameAttribute()
    {
        return $this->package_type === 'between_cities' ? 'Between Cities' : 'Local Ride';
    }

    // Status Color (Flutter ke liye useful)
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'completed' => 'green',
            'hold' => 'orange', 
            'cancelled' => 'red',
            'pending' => 'blue',
            default => 'gray'
        };
    }
}