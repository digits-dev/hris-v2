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
        Schema::create('ad_menus_privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ad_menus')->nullable();
            $table->integer('id_ad_privileges')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_menus_privileges');
    }
};
