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
        DB::statement("DROP VIEW IF EXISTS employee_total_logs_duration_view;");
        DB::statement("
        CREATE VIEW employee_total_logs_duration_view AS
        WITH first_last_times AS (
            SELECT 
                employee_id,
                DATE_FORMAT(date_clocked_in, '%Y-%m-%d') AS date_clocked_in,
                MIN(date_clocked_in) AS first_clock_in,
                MAX(date_clocked_out) AS last_clock_out
            FROM employee_logs
            GROUP BY 
                employee_id, 
                DATE_FORMAT(date_clocked_in, '%Y-%m-%d')
        ),
        all_times AS (
            SELECT
                employee_id,
                DATE_FORMAT(date_clocked_in, '%Y-%m-%d') AS date_clocked_in,
                SUM(TIME_TO_SEC(TIMEDIFF(date_clocked_out, date_clocked_in))) AS total_time_seconds
            FROM employee_logs
            GROUP BY
                employee_id,
                DATE_FORMAT(date_clocked_in, '%Y-%m-%d')
        )
        SELECT 
            flt.employee_id AS emp_id,
            flt.date_clocked_in,
            SEC_TO_TIME(at.total_time_seconds) AS total_time_bio_diff,
            SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(flt.last_clock_out, flt.first_clock_in))) AS total_time_filo_diff
        FROM first_last_times flt
        JOIN all_times at ON flt.employee_id = at.employee_id AND flt.date_clocked_in = at.date_clocked_in;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS employee_total_logs_duration_view;");
    }
};
