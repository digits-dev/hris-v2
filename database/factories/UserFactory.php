<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstname = fake()->firstName();
        $lastname = fake()->lastName();
        $middlename = fake()->lastName();
        $fullname = "$firstname $middlename $lastname";

        return [
            'first_name' => $firstname,
            'middle_name' => $middlename,
            'last_name' => $lastname,
            'full_name' => $fullname,
            'employee_id' => fake()->numerify('#######'),
            'image' => fake()->imageUrl(),
            'email' => fake()->unique()->safeEmail(),
            'hire_location' => fake()->city(),
            'hire_date' => now(),
            'company' => fake()->company(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => now()->addSeconds(rand(1,59))
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
