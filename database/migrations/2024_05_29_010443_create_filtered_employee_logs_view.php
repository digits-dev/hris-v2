<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS filtered_employee_logs_view;");
        DB::statement("
        CREATE VIEW filtered_employee_logs_view AS
        WITH latestlogs AS (
            SELECT
                employee_logs.id AS id,
                employee_logs.employee_id AS employee_id,
                employee_logs.date_clocked_in AS date_clocked_in,
                employee_logs.date_clocked_out AS date_clocked_out,
                employee_logs.date_entered AS date_entered,
                row_number() OVER (
                    PARTITION BY employee_logs.employee_id,
                    CAST(employee_logs.date_entered AS DATE)
                    ORDER BY employee_logs.date_entered DESC
                ) AS rn
            FROM
                employee_logs
        )
        SELECT
            latestlogs.id AS id,
            latestlogs.employee_id AS employee_id,
            latestlogs.date_clocked_in AS date_clocked_in,
            latestlogs.date_clocked_out AS date_clocked_out,
            latestlogs.date_entered AS date_entered
        FROM
            latestlogs
        WHERE
            latestlogs.rn = 1;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS filtered_employee_logs_view;");
    }
};