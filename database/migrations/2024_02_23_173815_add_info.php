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
        Schema::table('auctions', function (Blueprint $table) {
            //
          $table->string("estate_code")->nullable();
          $table->integer("area")->nullable();
          $table->integer("count_bathrooms")->nullable();
          $table->integer("count_bedrooms")->nullable();
          $table->integer("count_garage")->nullable();
          $table->integer("area_garage")->nullable();
          $table->string("year_build")->nullable();
          $table->string("type")->default("apartment");
          // apartment: chung cư
          // mini-apartment: chung cư mini apartment
          // townhouse: nhà phố
          // ground: đất nền
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auctions', function (Blueprint $table) {
            //
        });
    }
};
