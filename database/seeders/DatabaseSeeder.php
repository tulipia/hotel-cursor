<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        // Criar usuário admin se não existir
        $admin = User::updateOrCreate(
            [ 'email' => 'richard.fugisse@gmail.com' ],
            [
                'name' => 'Administrador',
                'password' => 'TaChovendoMacaco@123',
            ]
        );
        // Atribuir role de admin (id 1)
        if (method_exists($admin, 'roles')) {
            $admin->roles()->syncWithoutDetaching([1]);
        }

        $this->call([
            RoomSeeder::class,
        ]);
    }
}
