<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => fake()->word(),
            'color' => fake()->word(),
            'mrp' => fake()->randomFloat(2, 10, 1000),
            'price' => fake()->randomFloat(2, 10, 800),
            'product_id' => fake()->randomElement(Product::all()->pluck('id')->toArray()),
        ];
    }
}
