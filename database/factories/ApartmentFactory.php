<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unit' => 'A' . fake()->numberBetween(1, 10),
            'address' => fake()->address(),
            'description' => fake()->sentence(),
            'price' => fake()->randomElement([2500, 3000, 3500]),
            'user_id' => User::factory(),
        ];
    }
}
