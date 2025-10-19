<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alahda extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function alahdaCounts()
    {
        return $this->hasMany(AlahdaCount::class);
    }
}
