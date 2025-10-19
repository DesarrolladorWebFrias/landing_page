<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloatingButtonSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'position',
        'button_color',
        'icon_color',
        'button_text',
        'show_on_landing_only',
        'z_index'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_landing_only' => 'boolean'
    ];

    // Método estático para obtener configuración
    public static function getSettings()
    {
        return static::first() ?? static::createDefault();
    }

    // Crear configuración por defecto
    public static function createDefault()
    {
        return static::create([
            'is_active' => true,
            'position' => 'bottom-right',
            'button_color' => '#25D366',
            'icon_color' => '#FFFFFF',
            'button_text' => 'Contáctanos',
            'show_on_landing_only' => true,
            'z_index' => 9999
        ]);
    }

    // Helpers
    public function isVisibleOnPage($isLandingPage = false): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->show_on_landing_only && !$isLandingPage) {
            return false;
        }

        return true;
    }

    // Accesores
    public function getWhatsappUrlAttribute(): string
    {
        $socialSetting = SocialSetting::getPlatform('whatsapp');
        $number = $socialSetting->whatsapp_number ?? '9141247950';
        $message = $socialSetting->whatsapp_message ?? 'Hola, me interesa obtener más información sobre sus servicios';
        
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$number}?text={$encodedMessage}";
    }
}
