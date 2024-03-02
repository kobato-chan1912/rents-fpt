<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('bids', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('auction_id')->nullable();
      $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
      $table->unsignedBigInteger('user_id')->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->bigInteger("bid_price");
      $table->tinyInteger("status")->default(0);
      $table->bigInteger("deposit_price");
      $table->tinyInteger("deposit_status")->default(0);
      $table->bigInteger("remain_price");
      $table->tinyInteger("remain_status")->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bids');
  }
};
