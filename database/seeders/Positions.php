<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Positions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'position_name' => 'Manager',
           
            ],
            [
                'position_name' => 'Employee',

            ]
        ];
        
        foreach ($data as $position) {
            DB::table('positions')->updateOrInsert(['position_name' => $position['position_name']], $position);
        }
    }
}
