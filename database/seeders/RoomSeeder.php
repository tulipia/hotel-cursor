<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Criar tipos de quartos
        $roomTypes = RoomType::factory()
            ->count(6)
            ->create();

        // Para cada tipo de quarto, criar 15 quartos
        foreach ($roomTypes as $index => $roomType) {
            // Cada tipo de quarto começa em um andar diferente
            $baseFloor = ($index * 2) + 1;

            for ($i = 1; $i <= 15; $i++) {
                $roomNumber = $baseFloor . str_pad($i, 2, '0', STR_PAD_LEFT);

                Room::factory()->create([
                    'room_type_id' => $roomType->id,
                    'room_number' => $roomNumber,
                    'floor' => $baseFloor,
                ]);
            }
        }
    }
}
