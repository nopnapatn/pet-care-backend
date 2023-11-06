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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('status')->default('AVAILABLE')->comment('AVAILABLE, IN_USE, MAINTENANCE');
            $table->string('pet_type')->default('DOG');
            $table->integer('available_amount');
            $table->integer('max_pets');
            $table->string('start');
            $table->string('image_url')->nullable();
            //reviews
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
