<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder; // ⬅️ DEBE IMPORTARSE
use Database\Seeders\UserSeeder; // ⬅️ DEBE IMPORTARSE
use Database\Seeders\PageSeeder;
use Database\Seeders\SocialSettingsSeeder;
use Database\Seeders\TestimonialSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ❌ ELIMINAMOS ESTA CREACIÓN DE USUARIO ❌
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // ⬆️ ESTA CREACIÓN EN SOLITARIO CAUSA PROBLEMAS DE ORDEN Y ASIGNACIÓN DE ROLES

        // 1. LLAMAR A LOS SEEDERS EN ORDEN DE DEPENDENCIA
        $this->call([
            // PRIMERO: Roles (Tablas fuertes que NO dependen de nadie)
            RoleSeeder::class, 
            
            // SEGUNDO: Usuarios (Crear usuarios Y asignarles los roles que YA existen)
            UserSeeder::class, 
            
            // TERCERO: Contenido y otros (Tablas que dependen de Users o Pages)
            PageSeeder::class, 
            TestimonialSeeder::class, // Debe ir después de UserSeeder si Testimonial tiene 'created_by'
            
            // CUARTO: Configuraciones
            SocialSettingsSeeder::class,
            // (Otros seeders como PageSectionSeeder, ActivityLogSeeder, etc.)
        ]);

        $this->command->info('🎉 ¡Base de datos poblada exitosamente!');
        $this->command->info('');
        $this->command->info('🔑 Credenciales de acceso:');
        $this->command->info('   👑 Admin: admin@example.com / password');
        $this->command->info('   ✏️  Editor: editor@example.com / password');
        $this->command->info('   👤 User: user@example.com / password');
        $this->command->info('   🧪 Test: test@example.com / password'); // Este usuario debe ser creado dentro de UserSeeder
        $this->command->info('');
        $this->command->info('📊 Datos incluidos:');
        $this->command->info('   • 3 roles del sistema');
        $this->command->info('   • 4 usuarios de ejemplo (incluye test)');
        $this->command->info('   • 2 páginas con secciones');
        $this->command->info('   • 5 testimonios (4 publicados)');
        $this->command->info('   • Configuración de redes sociales');
    }
}