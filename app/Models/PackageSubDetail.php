<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSubDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function package()
    {
        return $this->belongsTo(PackageType::class, 'package_id');
    }
}
