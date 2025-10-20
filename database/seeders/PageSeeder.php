<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageSection;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // Crear página de landing
        $landingPage = Page::create([
            'slug' => 'landing',
            'title' => 'Página Principal',
            'meta_description' => 'Landing page principal de credibilidad digital',
            'meta_keywords' => 'credibilidad, digital, testimonios, servicios',
            'is_published' => true,
        ]);

        // Crear página Quiénes Somos
        $aboutPage = Page::create([
            'slug' => 'quienes-somos',
            'title' => 'Quiénes Somos',
            'meta_description' => 'Conoce más sobre nuestra empresa y valores',
            'meta_keywords' => 'empresa, misión, visión, valores, equipo',
            'is_published' => true,
        ]);

        // Secciones para Quiénes Somos
        $aboutSections = [
            [
                'section_key' => 'mision',
                'title' => 'Nuestra Misión',
                'content' => 'Proporcionar soluciones digitales innovadoras que impulsen la credibilidad y el crecimiento de nuestros clientes mediante tecnologías de vanguardia y un equipo comprometido.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'vision', 
                'title' => 'Nuestra Visión',
                'content' => 'Ser la empresa líder en transformación digital, reconocida por nuestra excelencia, innovación y compromiso con el éxito de nuestros clientes a nivel global.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'section_key' => 'valores',
                'title' => 'Nuestros Valores',
                'content' => '• Integridad en todas nuestras acciones<br>• Innovación constante<br>• Compromiso con la calidad<br>• Trabajo en equipo<br>• Enfoque al cliente<br>• Responsabilidad social',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'section_key' => 'equipo',
                'title' => 'Nuestro Equipo',
                'content' => 'Contamos con un equipo multidisciplinario de profesionales altamente calificados y apasionados por la tecnología, comprometidos con entregar resultados excepcionales.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'section_key' => 'tecnologia',
                'title' => 'Tecnología y Calidad',
                'content' => 'Utilizamos las últimas tecnologías y metodologías ágiles para garantizar soluciones robustas, escalables y de alta calidad que superen las expectativas de nuestros clientes.',
                'sort_order' => 5,
                'is_active' => true,
            ]
        ];

        foreach ($aboutSections as $section) {
            PageSection::create(array_merge($section, ['page_id' => $aboutPage->id]));
        }

        // Secciones para Landing Page
        $landingSections = [
            [
                'section_key' => 'hero',
                'title' => 'Impulsa Tu Credibilidad Digital',
                'content' => 'Soluciones innovadoras para construir confianza y autoridad en el mundo digital. Transformamos tu presencia online con testimonios verificados y contenido de impacto.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'servicios',
                'title' => 'Nuestros Servicios',
                'content' => 'Ofrecemos una gama completa de servicios diseñados para fortalecer tu credibilidad digital y conectar con tu audiencia de manera auténtica.',
                'sort_order' => 2,
                'is_active' => true,
            ]
        ];

        foreach ($landingSections as $section) {
            PageSection::create(array_merge($section, ['page_id' => $landingPage->id]));
        }

        $this->command->info('✅ Páginas y secciones creadas exitosamente');
        $this->command->info('   📄 Página: Landing');
        $this->command->info('   👥 Página: Quiénes Somos');
    }
}