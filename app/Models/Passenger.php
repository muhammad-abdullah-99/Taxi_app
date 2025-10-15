<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function appUser()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }
    public function list()
    {
        return $this->hasMany(PassengerList::class, 'passenger_id')->latest();
    }
    public function travel()
    {
        return $this->hasOne(Passenger::class, 'passenger_id');
    }
}
