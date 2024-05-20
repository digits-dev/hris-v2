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
            'full_name' => 'Mark Anthony Aguilar',
            'image' => fake()->imageUrl(),
            'employee_id' => fake()->numerify("#######"),
            'email' => 'markanthonyaguilar@digits.ph',
             'hire_location' => fake()->city(),
             'company' => fake()->company(),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
        ]);

        User::updateOrInsert(['email' => 'joelricmisa@digits.ph'],
        [
            'first_name' => 'Joel',
            'middle_name' => ' ',
            'last_name' => 'Ric',
            'full_name' => 'Joel Ric',
            'image' => fake()->imageUrl(),
            'employee_id' => fake()->numerify("#######"),
            'email' => 'joelricmisa@digits.ph',
             'hire_location' => fake()->city(),
             'company' => fake()->company(),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
        ]);

        User::updateOrInsert(['email' => 'marvinmosico@digits.ph'],
        [
            'first_name' => 'Marvin',
            'middle_name' => ' ',
            'last_name' => 'Mosico',
            'full_name' => 'Marvin Mosico',
            'image' => fake()->imageUrl(),
            'employee_id' => fake()->numerify("#######"),
            'email' => 'marvinmosico@digits.ph',
             'hire_location' => fake()->city(),
             'company' => fake()->company(),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
        ]);
    }
}
