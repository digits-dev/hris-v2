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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('status')->after('location_name')->default('ACTIVE');
        });

        Schema::table('positions', function (Blueprint $table) {
            $table->string('status')->after('position_name')->default('ACTIVE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
