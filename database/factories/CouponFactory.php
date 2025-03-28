<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'coupon_code' => fake()->unique()->word(),
            'coupon_value' => fake()->randomFloat(2, 10, 500),
            'coupon_type' => fake()->randomElement(['percent', 'rupee']),
            'cart_min_value' => fake()->randomFloat(2, 10, 2000),
            'status' => fake()->randomElement(['active', 'deactive']),
        ];
    }
}
