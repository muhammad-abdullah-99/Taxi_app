<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocsUpdate extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function document(){
        return $this->belongsTo(Document::class,'docs_id');
      }
}
