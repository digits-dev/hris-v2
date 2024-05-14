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
            'name' => 'Mark Anthony',
            'email' => 'markanthonyaguilar@digits.ph',
            'password' => bcrypt('qwerty')
        ]);

        User::updateOrInsert(['email' => 'joelricmisa@digits.ph'],
        [
            'name' => 'Joel Ric',
            'email' => 'joelricmisa@digits.ph',
            'password' => bcrypt('qwerty')
        ]);
    }
}
