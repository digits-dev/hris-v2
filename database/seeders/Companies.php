<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Companies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'company_name' => 'Digits Trading Corporation',
            ],
            [
                'company_name' => 'Tasteless Food Group',
            ]
       
        ];
        foreach ($data as $company) {
            DB::table('companies')->updateOrInsert(['company_name' => $company['company_name']], $company);
        }
    }
}
