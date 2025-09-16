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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('day');          // Thứ/ngày
            $table->text('breakfast');      // Bữa sáng
            $table->text('lunch');          // Bữa trưa
            $table->text('snack');          // Bữa xế
            $table->integer('order')->default(0); // thứ tự sắp xếp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
