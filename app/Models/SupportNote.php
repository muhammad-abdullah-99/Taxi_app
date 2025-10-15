<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportNote extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function support(){
      return $this->belongsTo(Support::class);
    }
}
