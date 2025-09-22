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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('parent')->nullable();
            $table->string('phone')->nullable();
            $table->string('grade')->nullable();
            $table->date('startdate')->nullable();
            $table->date('bod')->nullable();
            $table->string('image')->nullable();
            $table->string('classname')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->boolean('gender')->default(false);
            $table->boolean('status')->default(false);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
