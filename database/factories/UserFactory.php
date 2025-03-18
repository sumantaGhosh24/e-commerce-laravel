<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => fake()->name(),
            'lastName' => fake()->name(),
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'mobileNumber' => fake()->unique()->phoneNumber(),
            'image' => 'https://placehold.co/600x400.png',
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'zip' => fake()->postcode(),
            'addressline' => fake()->address(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
