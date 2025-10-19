<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  use HasFactory;
  protected $guarded = [];
  public function user()
  {
    return $this->belongsTo(AppUser::class, 'user_id');
  }
  public function details()
  {
    return $this->hasMany(WalletDetail::class);
  }
}
