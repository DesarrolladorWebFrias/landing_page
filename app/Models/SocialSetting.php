<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'is_active',
        'share_text',
        'whatsapp_number',
        'whatsapp_message',
        'button_color'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Métodos estáticos
    public static function getPlatform($platform)
    {
        return static::where('platform', $platform)->first();
    }

    public static function isPlatformActive($platform): bool
    {
        $setting = static::getPlatform($platform);
        return $setting ? $setting->is_active : false;
    }

    public static function getActivePlatforms()
    {
        return static::where('is_active', true)->get();
    }

    // Accesores
    public function getDefaultShareTextAttribute(): string
    {
        return $this->share_text ?: "Mira este testimonio increíble";
    }

    public function getDefaultWhatsappMessageAttribute(): string
    {
        return $this->whatsapp_message ?: "Hola, me interesa obtener más información sobre sus servicios";
    }
}
