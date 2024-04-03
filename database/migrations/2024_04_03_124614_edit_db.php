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
          $table->integer("start_price")->nullable()->change();
          $table->integer("jump_price")->nullable()->change();
          $table->integer("current_price")->nullable()->change();
          $table->dateTime("deadline_time")->nullable()->change();
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
