<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $testimonials = [
            [
                'title' => 'Transformación Digital Exitosa',
                'body' => 'El servicio de credibilidad digital transformó completamente nuestra presencia online. En solo 3 meses aumentamos nuestra tasa de conversión en un 45% y la confianza de nuestros clientes se incrementó notablemente. Recomiendo ampliamente sus servicios.',
                'author_name' => 'María González',
                'author_position' => 'Directora de Marketing',
                'organization' => 'TechSolutions Inc.',
                'created_by' => $admin->id,
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(10),
                'view_count' => 156
            ],
            [
                'title' => 'Increíble Experiencia',
                'body' => 'Trabajar con este equipo ha sido una de las mejores decisiones que hemos tomado. Su enfoque en la credibilidad digital nos ayudó a establecer una reputación sólida en el mercado. Los resultados superaron todas nuestras expectativas.',
                'author_name' => 'Carlos Rodríguez',
                'author_position' => 'CEO',
                'organization' => 'InnovateStartup',
                'created_by' => $admin->id,
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(5),
                'view_count' => 89
            ],
            [
                'title' => 'Profesionales de Alta Calidad',
                'body' => 'La atención al detalle y el profesionalismo del equipo son excepcionales. Implementaron estrategias personalizadas que se alinearon perfectamente con nuestros objetivos de negocio. Definitivamente volveremos a trabajar con ellos.',
                'author_name' => 'Ana Martínez',
                'author_position' => 'Gerente de Comunicaciones',
                'organization' => 'GlobalCorp',
                'created_by' => $admin->id,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(2),
                'view_count' => 42
            ],
            [
                'title' => 'Resultados Tangibles',
                'body' => 'Desde que implementamos su sistema de testimonios verificados, hemos visto un aumento del 60% en leads calificados. La plataforma es intuitiva y el soporte técnico siempre está disponible cuando lo necesitamos.',
                'author_name' => 'Roberto Sánchez',
                'author_position' => 'Director Comercial',
                'organization' => 'Enterprise Solutions',
                'created_by' => $admin->id,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDay(),
                'view_count' => 23
            ],
            [
                'title' => 'Recomendación 100%',
                'body' => 'Como empresa emergente, la credibilidad era nuestro mayor desafío. Este servicio nos ayudó a construir confianza rápidamente con nuestros clientes potenciales. El retorno de inversión ha sido extraordinario.',
                'author_name' => 'Laura Fernández',
                'author_position' => 'Fundadora',
                'organization' => 'NextGen Tech',
                'created_by' => $admin->id,
                'is_published' => false, // Este está en borrador
                'is_featured' => false,
                'published_at' => null,
                'view_count' => 0
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('✅ Testimonios creados exitosamente');
        $this->command->info('   📝 5 testimonios (4 publicados, 1 en borrador)');
        $this->command->info('   ⭐ 2 testimonios destacados');
    }
}
