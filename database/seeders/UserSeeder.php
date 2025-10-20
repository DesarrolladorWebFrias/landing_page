<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ELIMINAR CUALQUIER USUARIO CREADO POR OTROS SEEDERS/FACTORIES (Recomendado)
        // Esto previene conflictos de IDs y duplicidades con test@example.com
        User::whereIn('email', ['admin@example.com', 'editor@example.com', 'user@example.com', 'test@example.com'])->delete();
        

        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Crear usuario editor
        $editor = User::create([
            'name' => 'Editor Content',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Crear usuario básico
        $user = User::create([
            'name' => 'Usuario Regular',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // 2. MANEJO DEL USUARIO DE PRUEBA (test@example.com)
        // Ya no buscamos 'test@example.com' porque lo borramos arriba. 
        // Lo creamos aquí para tener control total sobre su ID y datos.
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // Asume que el factory usa 'password'
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // 3. ASIGNAR ROLES
        // Usamos firstOrFail() para asegurar que los roles existen, 
        // ya que el RoleSeeder se ejecutó antes.
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $editorRole = Role::where('name', 'editor')->firstOrFail();
        $userRole = Role::where('name', 'user')->firstOrFail();

        // ➡️ CAMBIAMOS attach() por sync() ⬅️
        // sync() asegura que la tabla pivot solo tenga esta única relación, 
        // eliminando cualquier duplicidad anterior.
        $admin->roles()->sync([$adminRole->id]);
        $editor->roles()->sync([$editorRole->id]);
        $user->roles()->sync([$userRole->id]);
        
        $testUser->roles()->sync([$userRole->id]);


        $this->command->info('✅ Usuarios creados exitosamente:');
        $this->command->info('   👑 Admin: admin@example.com / password');
        $this->command->info('   ✏️  Editor: editor@example.com / password');
        $this->command->info('   👤 User: user@example.com / password');
        $this->command->info('   🧪 Test: test@example.com / password');
    }
}