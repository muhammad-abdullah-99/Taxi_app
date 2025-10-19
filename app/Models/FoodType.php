<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function food_price(){
      return $this->hasMany(FoodPrice::class,'food_type_id');
    }  
}
