<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function files(){
      return $this->hasMany(EmployeeFile::class,'employee_id');
    }  
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
    return $this->hasMany(EmployeeDocument::class);
}

}
