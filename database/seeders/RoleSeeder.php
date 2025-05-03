<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrador do sistema',
            ],
            [
                'name' => 'manager',
                'description' => 'Gerente do hotel',
            ],
            [
                'name' => 'receptionist',
                'description' => 'Recepcionista',
            ],
            [
                'name' => 'housekeeping',
                'description' => 'Serviços de limpeza',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
