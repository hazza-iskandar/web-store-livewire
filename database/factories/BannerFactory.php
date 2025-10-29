<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => rand(1, 10),
            'title' => fake('id_ID')->sentence(),
            'desc' => fake()->sentence(8),
            'type' => fake()->randomElement(['highlight', 'slider']),
             'is_active' => fake()->boolean(80), // 80% aktifk
        ];
    }
}
