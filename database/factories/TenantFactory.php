<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'apartment_id' => Apartment::factory(),
            'email' => fake()->unique()->safeEmail(),
            'contact' => fake()->phoneNumber(),
            'occupantsQty' => fake()->numberBetween(1,5),
            'start_date' => fake()->dateTimeThisYear()
        ];
    }
}
