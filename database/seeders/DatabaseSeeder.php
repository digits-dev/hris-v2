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
       $this->call([Companies::class]);
       $this->call([Locations::class]);
       $this->call([Positions::class]);
       $this->call([Departments::class]);
    }
}
