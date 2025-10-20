<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialSetting;
use App\Models\FloatingButtonSetting;

class SocialSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Configuración de redes sociales
        $platforms = [
            [
                'platform' => 'facebook',
                'is_active' => true,
                'share_text' => 'Mira este testimonio increíble sobre credibilidad digital',
                'button_color' => '#1877F2'
            ],
            [
                'platform' => 'twitter',
                'is_active' => true, 
                'share_text' => 'Check out this amazing testimonial about digital credibility',
                'button_color' => '#1DA1F2'
            ],
            [
                'platform' => 'linkedin',
                'is_active' => true,
                'share_text' => 'Recomiendo estos servicios de credibilidad digital',
                'button_color' => '#0077B5'
            ],
            [
                'platform' => 'instagram',
                'is_active' => true,
                'share_text' => 'Testimonio verificado de nuestros servicios digitales',
                'button_color' => '#E4405F'
            ],
            [
                'platform' => 'whatsapp',
                'is_active' => true,
                'whatsapp_number' => '9141247950',
                'whatsapp_message' => 'Hola, me interesa obtener más información sobre sus servicios de credibilidad digital',
                'button_color' => '#25D366'
            ]
        ];

        foreach ($platforms as $platform) {
            SocialSetting::create($platform);
        }

        // Configuración del botón flotante
        FloatingButtonSetting::create([
            'is_active' => true,
            'position' => 'bottom-right',
            'button_color' => '#25D366',
            'icon_color' => '#FFFFFF',
            'button_text' => 'Contáctanos',
            'show_on_landing_only' => true,
            'z_index' => 9999
        ]);

        $this->command->info('✅ Configuración de redes sociales creada');
        $this->command->info('   📱 Plataformas: Facebook, Twitter, LinkedIn, Instagram, WhatsApp');
    }
}
