<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();
        $slugName = \Str::slug($name);
        return [
            'alias'         => $slugName,
            'name'          => $name,
            'image_url'     => fake()->imageUrl(),
            'is_closed'     => false,
            'url'           => 'http://localhost:8000/' . $slugName,
            'review_count'  => fake()->numberBetween(1, 50),
            'rating'        => fake()->numberBetween(1, 5),
            'lattitude'     => fake()->latitude(),
            'longtitude'    => fake()->longitude(),
            'price'         => fake()->numberBetween(1, 4),
            'phone'         => fake()->phoneNumber(),
            'display_phone' => fake()->phoneNumber(),
            'distance'      => fake()->numberBetween(100, 3000),
        ];
    }
}
