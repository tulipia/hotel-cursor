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
        if (!User::where('email', 'test@example.com')->exists()) {
            $user = User::factory()->create([
                'name' => 'admin',
                'email' => 'test@example.com',
            ]);

            // Atribuir role de admin
            $user->roles()->attach(1); // ID 1 é o admin
        }

        $this->call([
            RoomSeeder::class,
        ]);
    }
}
