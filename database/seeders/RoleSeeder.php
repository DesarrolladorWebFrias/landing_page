<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrador del sistema con acceso completo'
            ],
            [
                'name' => 'editor', 
                'description' => 'Editor de contenido, puede gestionar testimonios y páginas'
            ],
            [
                'name' => 'user',
                'description' => 'Usuario básico del sistema'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $this->command->info('✅ Roles creados exitosamente: admin, editor, user');
    }
}