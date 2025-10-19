<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletDetail extends Model
{
    use HasFactory;
     protected $guarded=[];
    public function wallet(){
      return $this->belongsTo(Wallet::class,'wallet_id');
    }
    public function travel(){
  return $this->belongsTo(Travel::class,'travel_id');
}
}
