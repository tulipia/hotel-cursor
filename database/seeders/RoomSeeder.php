<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                    'slug' => Str::slug($roomNumber . '-' . uniqid()),
                    'floor' => $baseFloor,
                ]);
            }
        }

        // Exemplo de seed para RoomType com prices_per_person
        RoomType::create([
            'name' => 'Quarto Standard',
            'description' => 'Quarto confortável para até 2 pessoas.',
            'price_per_night' => 200,
            'prices_per_person' => json_encode([
                '1' => 200,
                '2' => 350
            ]),
            'breakfast_extra' => 30,
            'capacity' => 2,
            'bed_count' => 1,
            'bed_type' => 'Casal',
            'amenities' => json_encode(['Wi-Fi', 'Ar-condicionado', 'TV']),
        ]);
        RoomType::create([
            'name' => 'Quarto Família',
            'description' => 'Ideal para famílias, comporta até 4 pessoas.',
            'price_per_night' => 400,
            'prices_per_person' => json_encode([
                '1' => 400,
                '2' => 500,
                '3' => 600,
                '4' => 700
            ]),
            'breakfast_extra' => 50,
            'capacity' => 4,
            'bed_count' => 2,
            'bed_type' => 'Casal + Solteiro',
            'amenities' => json_encode(['Wi-Fi', 'Ar-condicionado', 'TV', 'Frigobar']),
        ]);
    }
}
