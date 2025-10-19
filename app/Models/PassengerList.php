<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerList extends Model
{
    use HasFactory;
    protected $guarded=[];



    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

}
