<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address1' => fake()->streetAddress(),
            'city'     => fake()->cityPrefix(),
            'zip_code' => fake()->postcode(),
            'country'  => fake()->country(),
            'state'    => fake()->state(),
        ];
    }
}
