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
    Schema::create('auctions', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('city_id')->nullable();
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
      $table->unsignedBigInteger('user_id')->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->string("title");
      $table->string("thumbnail");
      $table->text("galleries");
      $table->text("description");
      $table->text("address");
      $table->bigInteger("start_price");
      $table->bigInteger("jump_price");
      $table->bigInteger("current_price")->default(0);
      $table->dateTime("deadline_time");
      $table->string("status")->default("trading");
      $table->text("note")->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('auctions');
  }
};
