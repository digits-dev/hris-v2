<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS dashboard_attendance_statistics_view;");
        DB::statement("
        CREATE VIEW dashboard_attendance_statistics_view AS
        WITH LatestLogs AS (
            SELECT 
                employee_id,
                date_clocked_in,
                date_clocked_out,
                ROW_NUMBER() OVER (PARTITION BY employee_id ORDER BY date_entered DESC) AS rn
            FROM employee_logs
        )
        
        SELECT 
            users.company_id,
            -- Count of users who have clocked in today and have not clocked out yet
            COUNT(CASE WHEN LatestLogs.date_clocked_out IS NULL THEN 1 END) AS clocked_in_count,
        
            -- Count of users who have clocked in and clocked out today
            COUNT(CASE WHEN LatestLogs.date_clocked_out IS NOT NULL THEN 1 END) AS clocked_out_count,
        
            -- Count of users who have not clocked in and out today
            COUNT(CASE WHEN LatestLogs.date_clocked_in IS NULL AND LatestLogs.date_clocked_out IS NULL THEN 1 END) AS not_clocked_in_count
        
        FROM users
        LEFT JOIN LatestLogs ON users.employee_id = LatestLogs.employee_id
        WHERE LatestLogs.rn = 1
        GROUP BY users.company_id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS dashboard_attendance_statistics_view;");
    }
};
