<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([AdminAccount::class]);
       $this->call([AdModules::class]);
       $this->call([AdMenus::class]);
       $this->call([AdPrivileges::class]);
       $this->call([AdMenuPrivileges::class]);

        \App\Models\User::factory(100)->create();
        \App\Models\Employee::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
