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
        Schema::table('employee_logs', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('current_location');
            $table->integer('company_id');
            $table->integer('hire_location_id');
            $table->integer('current_location_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_logs', function (Blueprint $table) {
            $table->string('location');
            $table->string('current_location');
            $table->dropColumn('company_id');
            $table->dropColumn('hire_location_id');
            $table->dropColumn('current_location_id');
        });
    }
};
