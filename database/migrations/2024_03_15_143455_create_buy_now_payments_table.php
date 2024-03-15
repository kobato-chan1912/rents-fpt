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
        Schema::create('buy_now_payments', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('auction_id')->nullable();
          $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
          $table->unsignedBigInteger('user_id')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->integer("price");
          $table->string("paid_status")->default("not_paid");
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_now_payments');
    }
};
