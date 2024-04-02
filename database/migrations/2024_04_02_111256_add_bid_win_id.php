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
          $table->unsignedBigInteger('buy_win_id')->nullable();
          $table->foreign('buy_win_id')->references('id')->on('buy_now_payments')->onDelete('cascade');
          $table->unsignedBigInteger('bid_win_id')->nullable();
          $table->foreign('bid_win_id')->references('id')->on('bids')->onDelete('cascade');

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
