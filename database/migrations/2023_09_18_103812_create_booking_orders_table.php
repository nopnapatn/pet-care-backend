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
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->foreignId('room_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            // $table->foreignId('pet_id')->constrained();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('pets_amount');
            $table->decimal('total_price', 10, 2);
            $table->text('owner_instruction')->nullable();
            $table->string('status')->nullable()->default('BOOKED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_orders');
    }
};
