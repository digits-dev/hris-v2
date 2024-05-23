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
        Schema::dropIfExists('employee_logs');

        Schema::create('employee_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('time_entry_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->timestamp('date_clocked_in')->nullable();
            $table->timestamp('date_clocked_out')->nullable();
            $table->timestamp('date_entered')->nullable();
            $table->integer('entered_by')->nullable();
            $table->timestamp('date_modified')->nullable();
            $table->integer('modified_by')->nullable();
            $table->timestamp('date_approved')->nullable();
            $table->integer('approved_by')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('entry_method')->nullable();
            $table->mediumText('add_edit_reason')->nullable();
            $table->integer('entry_points_earned')->nullable();
            $table->integer('clock_in_terminal_id')->nullable();
            $table->integer('clock_out_terminal_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_logs');
    }
};
