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
        // Alter columns
        Schema::table('fmd_employee_tables', function (Blueprint $table) {
            $table->longText('fmd_data')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fmd_employee_tables', function (Blueprint $table) {
            $table->string('fmd_data')->nullable()->change();
        });
    }
};
