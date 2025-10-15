<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPrice extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function food_type(){
      return $this->belongsTo(FoodType::class,'food_type_id');
    }  
  
}
