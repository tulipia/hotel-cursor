<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    public function definition(): array
    {
        $bedTypes = ['Single', 'Double', 'Queen', 'King'];
        $bedType = fake()->randomElement($bedTypes);
        $capacity = match($bedType) {
            'Single' => 1,
            'Double' => 2,
            'Queen' => 2,
            'King' => 2,
        };

        $amenities = ['tv', 'ac', 'wifi']; // Amenidades básicas que todos os quartos têm

        // Adiciona amenidades opcionais com probabilidades diferentes
        if (fake()->boolean(70)) $amenities[] = 'balcony';
        if (fake()->boolean(50)) $amenities[] = 'sea_view';
        if (fake()->boolean(80)) $amenities[] = 'bathtub';
        if (fake()->boolean(90)) $amenities[] = 'minibar';

        return [
            'name' => fake()->unique()->randomElement([
                'Standard Single',
                'Standard Double',
                'Deluxe',
                'Suite',
                'Executive Suite',
                'Presidential Suite',
            ]),
            'description' => fake()->paragraph(),
            'price_per_night' => fake()->randomFloat(2, 100, 1000),
            'capacity' => $capacity,
            'bed_count' => fake()->numberBetween(1, 2),
            'bed_type' => $bedType,
            'amenities' => $amenities,
            'breakfast_extra' => fake()->randomFloat(2, 10, 50),
            'prices_per_person' => function() use ($capacity) {
                $prices = [];
                $base = fake()->randomFloat(2, 100, 1000);
                for ($i = 1; $i <= $capacity; $i++) {
                    $prices[$i] = $base + ($i - 1) * fake()->randomFloat(2, 50, 150);
                }
                return $prices;
            },
        ];
    }
}
