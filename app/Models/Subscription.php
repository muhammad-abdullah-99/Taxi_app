<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function appUser()
    {
        return $this->belongsTo(AppUser::class,'user_id');
    }
    public function package()
    {
        return $this->belongsTo(PackageType::class,'package_id');
    }
}
