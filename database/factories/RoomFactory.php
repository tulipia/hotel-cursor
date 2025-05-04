<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        $floor = fake()->numberBetween(1, 10);

        return [
            'room_type_id' => null, // Será definido no seeder
            'room_number' => null, // Será definido no seeder
            'slug' => null, // Será definido no seeder
            'floor' => $floor,
            'status' => fake()->randomElement(['available', 'occupied', 'maintenance', 'cleaning']),
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}
