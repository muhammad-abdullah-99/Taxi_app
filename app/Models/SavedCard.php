<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class SavedCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'moyasar_token', 'card_brand', 'last_four',
        'exp_month', 'exp_year', 'card_holder_name',
        'is_default', 'is_active', 'fingerprint',
        'last_used_at', 'usage_count'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    protected $hidden = ['moyasar_token'];

    public function setMoyasarTokenAttribute($value)
    {
        $this->attributes['moyasar_token'] = Crypt::encryptString($value);
    }

    // public function getMoyasarTokenAttribute($value)
    // {
    //     return $value ? Crypt::decryptString($value) : null;
    // }

    public function getMoyasarTokenAttribute($value)
    {
        if (!$value) return null;
        
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            // ✅ YAHAN FIX KARO - Agar decrypt fail ho toh
            \Log::warning('SavedCard moyasar_token decryption failed', [
                'saved_card_id' => $this->id,
                'user_id' => $this->user_id,
                'error' => $e->getMessage()
            ]);
            return null; // Return null so system can handle gracefully
        }
    }    

    public function user()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    public function markAsDefault()
    {
        self::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['is_default' => false]);
        $this->update(['is_default' => true]);
    }

    public function recordUsage()
    {
        $this->increment('usage_count');
        $this->update(['last_used_at' => now()]);
    }

    public function getDisplayNameAttribute()
    {   
        return ucfirst($this->card_brand) . ' •••• ' . $this->last_four;
    }

    public function isExpired()
    {
        $expiry = \Carbon\Carbon::createFromFormat('m/Y', $this->exp_month . '/' . $this->exp_year);
        return now()->greaterThan($expiry->endOfMonth());
    }
}
