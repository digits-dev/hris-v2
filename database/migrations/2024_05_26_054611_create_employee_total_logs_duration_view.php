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
        CREATE VIEW employee_total_logs_duration_view
        AS
        SELECT 
            employee_logs.employee_id AS emp_id,
            DATE_FORMAT(employee_logs.date_clocked_in, '%Y-%m-%d') AS date_clocked_in,
            SEC_TO_TIME(SUM(TIME_TO_SEC(
                CONCAT(
                    LPAD(TIMESTAMPDIFF(HOUR, employee_logs.date_clocked_in, employee_logs.date_clocked_out), 2, '0'), ':',
                    LPAD(MOD(TIMESTAMPDIFF(MINUTE, employee_logs.date_clocked_in, employee_logs.date_clocked_out), 60), 2, '0'), ':00'
                )
            ))) AS total_time_diff
        FROM employee_logs
        GROUP BY 
            employee_logs.employee_id,
            DATE_FORMAT(employee_logs.date_clocked_in, '%Y-%m-%d');
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
