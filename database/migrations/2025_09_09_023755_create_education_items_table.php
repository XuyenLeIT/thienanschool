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
        Schema::create('education_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_content_id')->constrained()->onDelete('cascade');
            $table->string('image'); // Ảnh nhỏ
            $table->string('overlay_text'); // Text overlay
            $table->integer('sort_order')->default(0); // Thứ tự hiển thị
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_items');
    }
};
