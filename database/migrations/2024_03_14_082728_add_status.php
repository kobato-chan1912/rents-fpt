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
        Schema::table('auction_registers', function (Blueprint $table) {
            //
          $table->dropColumn("is_paid");
          $table->string("paid_status")->default("not_paid");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auction_registers', function (Blueprint $table) {
            //
        });
    }
};
