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
            'last_name' => 'Aguilar',
            'full_name' => 'Mark Anthony Aguilar',
            'employee_id' => fake()->numerify("#######"),
            'email' => 'markanthonyaguilar@digits.ph',
             'location' => fake()->city(),
             'company' => fake()->company(),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
        ]);

        User::updateOrInsert(['email' => 'joelricmisa@digits.ph'],
        [
            'first_name' => 'Joel',
            'last_name' => 'Ric',
            'full_name' => 'Joel Ric',
            'employee_id' => fake()->numerify("#######"),
            'email' => 'joelricmisa@digits.ph',
             'location' => fake()->city(),
             'company' => fake()->company(),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
        ]);

        User::updateOrInsert(['email' => 'marvinmosico@digits.ph'],
        [
            'first_name' => 'Marvin',
            'last_name' => 'Mosico',
            'full_name' => 'Marvin Mosico',
            'employee_id' => fake()->numerify("#######"),
            'email' => 'marvinmosico@digits.ph',
             'location' => fake()->city(),
             'company' => fake()->company(),
            'password' => bcrypt('qwerty'),
            'id_ad_privileges' => 1,
        ]);
    }
}
