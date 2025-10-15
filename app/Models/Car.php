<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function carDrivers()
    {
        return $this->hasMany(CarDriver::class);
    }
    public function CarMaintenance()
    {
        return $this->hasMany(CarMaintenance::class);
    }
    public function snd()
    {
        return $this->hasMany(Snd::class);
    }
    public function documents()
{
    return $this->hasMany(CarDocument::class);
}



// آخر عملية استلام أو تسليم
public function latestCarDriver()
{
    return $this->hasOne(CarDriver::class)->latestOfMany();
}



}
