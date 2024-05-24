<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeLog>
 */
class EmployeeLogFactory extends Factory
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
            'hire_location_id' => fake()->numberBetween(1,2),
            'current_location_id' => fake()->numberBetween(1,2),
            'company_id' => fake()->numberBetween(1,2),
            'time_in' => now(),
            'time_out' => now()->addHours(rand(7,12))->addMinutes(rand(0,59)),
        ];
    }
}
