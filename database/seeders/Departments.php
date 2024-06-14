<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Departments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'department_name' => 'BPG',
                'coa_id' => 1,
            ],
            [
                'department_name' => 'ISD',
                'coa_id' => 2,
            ]
        ];
        
        foreach ($data as $department) {
            DB::table('departments')
            ->updateOrInsert([
                'department_name' => $department['department_name'], 
                'coa_id' => $department['coa_id']
            ], $department);
        }
    }
}
