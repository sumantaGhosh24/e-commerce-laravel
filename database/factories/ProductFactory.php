<?php

namespace Database\Factories;

use App\Models\Category;
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
            'title' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'content' => fake()->text(),
            'mrp' => fake()->randomFloat(2, 10, 1000),
            'price' => fake()->randomFloat(2, 10, 800),
            'meta_title' => fake()->sentence(),
            'meta_desc' => fake()->sentence(),
            'meta_keyword' => fake()->sentence(),
            'category_id' => fake()->randomElement(Category::all()->pluck('id')->toArray())
        ];
    }
}
