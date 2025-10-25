<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function notes()
    {
        return $this->hasMany(SupportNote::class);
    }
    public function user(){
      return $this->belongsTo(User::class);
    }
     public function appUser(){
      return $this->belongsTo(AppUser::class);
    }
} 
