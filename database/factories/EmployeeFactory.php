<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name'=> $this->faker->lastName,
            'location' => $this->faker->city,
            'current_location' => $this->faker->city(),
            'time_in' => now(),
            'time_out' => now()->addHours(rand(7,12))->addMinutes(rand(0,59)),
        ];
    }
}
