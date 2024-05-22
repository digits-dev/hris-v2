<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrInsert(['email' => 'markanthonyaguilar@digits.ph'],
        [
            'first_name' => 'Mark Anthony',
            'middle_name' => ' ',
            'last_name' => 'Aguilar',
            'image' => fake()->imageUrl(),
            'employee_id' => fake()->numerify("#######"),
            'email' => 'markanthonyaguilar@digits.ph',
             'hire_location_id' => fake()->numberBetween(1,2),
             'hire_date' => now(),
             'company_id' => fake()->numberBetween(1,2),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
            'position' => 'Dev'
        ]);

        User::updateOrInsert(['email' => 'joelricmisa@digits.ph'],
        [
            'first_name' => 'Joel',
            'middle_name' => 'Ric',
            'last_name' => 'Ric',
            'image' => fake()->imageUrl(),
            'employee_id' => fake()->numerify("#######"),
            'email' => 'joelricmisa@digits.ph',
             'hire_location_id' => fake()->numberBetween(1,2),
             'hire_date' => now(),
             'company_id' => fake()->numberBetween(1,2),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
            'position' => 'Dev'
        ]);

        User::updateOrInsert(['email' => 'marvinmosico@digits.ph'],
        [
            'first_name' => 'Marvin',
            'middle_name' => ' ',
            'last_name' => 'Mosico',
            'image' => fake()->imageUrl(),
            'employee_id' => fake()->numerify("#######"),
            'email' => 'marvinmosico@digits.ph',
             'hire_location_id' => fake()->numberBetween(1,2),
             'hire_date' => now(),
             'company_id' => fake()->numberBetween(1,2),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
            'position' => 'Dev'
        ]);
    }
}
