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
        Schema::create('special_feature_subdes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('special_feature_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('icon_class');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_feature_subdes');
    }
};
