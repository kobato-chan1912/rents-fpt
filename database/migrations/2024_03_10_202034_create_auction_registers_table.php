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
    Schema::create('auction_registers', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('auction_id')->nullable();
      $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
      $table->unsignedBigInteger('user_id')->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->integer("price");
      $table->tinyInteger("is_paid")->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('auction_registers');
  }
};
