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
        Schema::create('fmd_employee_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fmd_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('fmd_data')->nullable();
            $table->string('store_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fmd_employee_tables');
    }
};
