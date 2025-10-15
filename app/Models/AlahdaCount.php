<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlahdaCount extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function alahda()
    {
        return $this->belongsTo(Alahda::class);
    }
}

