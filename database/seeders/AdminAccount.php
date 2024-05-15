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
            'employee_id' => fake()->numerify("#######"),
            'email' => 'markanthonyaguilar@digits.ph',
             'location' => fake()->city(),
            'password' => bcrypt('qwerty')
        ]);

        User::updateOrInsert(['email' => 'joelricmisa@digits.ph'],
        [
            'first_name' => 'Joel',
            'last_name' => 'Ric',
            'employee_id' => fake()->numerify("#######"),
            'email' => 'joelricmisa@digits.ph',
             'location' => fake()->city(),
            'password' => bcrypt('qwerty')
        ]);
    }
}
