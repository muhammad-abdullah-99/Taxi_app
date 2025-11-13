<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetweenCity extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function travel(){
        return $this->hasMany(Travel::class,'between_city_id');
    }

    // Transport types with Arabic names
    const TRANSPORT_TYPES = [
        'limousine_taxi' => 'تاكسي ليموزين',
        'private_car' => 'سيارة خاصة', 
        'bus' => 'حافلة'
    ];

    // Accessor for Arabic names
    public function getTransportTypesArabicAttribute()
    {
        if (!$this->transport_types) return [];

        $typesArray = explode(',', $this->transport_types);
        $arabicNames = [];
        
        foreach ($typesArray as $type) {
            $cleanType = trim($type);
            if (isset(self::TRANSPORT_TYPES[$cleanType])) {
                $arabicNames[] = self::TRANSPORT_TYPES[$cleanType];
            }
        }
        
        return $arabicNames;
    }
}