<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snd extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
    public function geha()
    {
        return $this->belongsTo(Geha::class, 'geha_id');
    }
}
