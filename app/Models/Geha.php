<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geha extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function snd()
    {
        return $this->hasMany(Snd::class);
    }
}
