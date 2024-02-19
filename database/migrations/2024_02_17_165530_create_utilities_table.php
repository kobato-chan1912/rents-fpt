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
        Schema::create('utilities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        \App\Models\Utility::create(["name" => "Điều Hòa Không Khí"]);
        \App\Models\Utility::create(["name" => "Bể Bơi"]);
        \App\Models\Utility::create(["name" => "Điều Hòa Trung Tâm"]);
        \App\Models\Utility::create(["name" => "Spa & Massage"]);
        \App\Models\Utility::create(["name" => "Cho Phép Nuôi Thú Cưng"]);
        \App\Models\Utility::create(["name" => "Khu vực yên tĩnh"]);
        \App\Models\Utility::create(["name" => "Phòng Tập Gym"]);
        \App\Models\Utility::create(["name" => "Báo Động"]);
        \App\Models\Utility::create(["name" => "Rèm Cửa"]);
        \App\Models\Utility::create(["name" => "Wi-Fi Miễn Phí"]);
        \App\Models\Utility::create(["name" => "Chỗ Đậu Xe Ô Tô"]);
        \App\Models\Utility::create(["name" => "Miễn Thuế 3 Năm"]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilities');
    }
};
