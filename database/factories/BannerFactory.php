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
            'heading1' => fake()->sentence(),
            'heading2' => fake()->sentence(),
            'btn_txt' => fake()->word(),
            'btn_link' => fake()->url(),
            'image' => '600x400.png',
            'status' => fake()->randomElement(['active', 'deactive']),
        ];
    }
}
