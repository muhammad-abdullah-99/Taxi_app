<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded=[];



    public function appUser()
    {
        return $this->belongsTo(AppUser::class,'user_id');
    }
    public function passengers()
{
    return $this->hasMany(Passenger::class, 'user_id', 'user_id');
}
}
