<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeLogs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'time_entry_id' => 1, 
                'employee_id' => 6913693, 
                'group_id' => 1, 
                'date_clocked_in' => '2024-05-24 08:00:00', 
                'date_clocked_out' => '2024-05-24 12:00:00', 
                'date_entered' => '2024-05-24 08:00:00', 
                'entered_by' => 3, 
                'date_modified' => '', 
                'modified_by' => '', 
                'date_approved' => '2024-05-26 12:46:12', 
                'approved_by' => 1, 
                'is_active' => 1, 
                'entry_method' => 1234, 
                'add_edit_reason' => '', 
                'entry_points_earned' => '', 
                'clock_in_terminal_id' => 111, 
                'clock_out_terminal_id' => 111, 
                'created_at' => '2024-05-24 08:00:00', 
                'updated_at' => NULL
            ],
            [
                'time_entry_id' => 1, 
                'employee_id' => 6913693, 
                'group_id' => 1, 
                'date_clocked_in' => '2024-05-24 08:00:00', 
                'date_clocked_out' => '2024-05-24 12:00:00', 
                'date_entered' => '2024-05-24 08:00:00', 
                'entered_by' => 3, 
                'date_modified' => '', 
                'modified_by' => '', 
                'date_approved' => '2024-05-26 12:46:12', 
                'approved_by' => 1, 
                'is_active' => 1, 
                'entry_method' => 1234, 
                'add_edit_reason' => '', 
                'entry_points_earned' => '', 
                'clock_in_terminal_id' => 111, 
                'clock_out_terminal_id' => 111, 
                'created_at' => '2024-05-24 08:00:00', 
                'updated_at' => NULL

            ]
        ];
        
        foreach ($data as $entry) {
            DB::table('employee_logs')->insert($entry);
        }
    }
}
