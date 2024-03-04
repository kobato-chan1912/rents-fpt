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
    Schema::create('feedback', function (Blueprint $table) {
      $table->id();
      $table->integer("star")->default(0);
      $table->unsignedBigInteger('auction_id');
      $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->string("content");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('feedback');
  }
};
