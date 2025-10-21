<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => 1,
            'category_id' => rand(1, 3),
            'title' => fake('id_ID')->sentence(),
            'slug' => fake('id_ID')->unique()->word(),
            'price' => fake('id_ID')->numberBetween(1000, 100000),
            'stock' => rand(20, 100),
            'status' => fake()->randomElement(['publish', 'draft']),
            'total_sold' => rand(10, 50),
            'desc' => implode(', ', fake('id_ID')->sentences(8))
        ];
    }
}
    