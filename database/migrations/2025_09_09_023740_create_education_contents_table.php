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
        Schema::create('education_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề
            $table->string('main_image'); // Ảnh chính
            $table->string('caption')->nullable(); // Caption dưới ảnh
            $table->text('description')->nullable(); // Mô tả tổng quát
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_contents');
    }
};
