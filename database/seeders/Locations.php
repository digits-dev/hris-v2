<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Locations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'location_name' => 'DW MOA',
                'created_by' => 1,
                'updated_by' => 1,
        
            ],
            [
                'location_name' => 'Digits Headquarters',
                'created_by' => 1,
                'updated_by' => 1,
            ],

       
        ];
        foreach ($data as $location) {
            DB::table('locations')->updateOrInsert(['location_name' => $location['location_name']], $location);
        }
    }
}
