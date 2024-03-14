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
        Schema::table('bids', function (Blueprint $table) {
            //
          $table->smallInteger("status")->nullable()->change();
          $table->integer("tax_price");
          $table->tinyInteger("tax_status")->nullable();
          $table->integer("remain_price");
          $table->tinyInteger("remain_status")->nullable();
          $table->unsignedBigInteger('auction_register_id')->nullable();
          $table->foreign('auction_register_id')->references('id')->on('auction_registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bids', function (Blueprint $table) {
            //
        });
    }
};
