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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_item_id')->constrained();
            $table->string('service_date');
            $table->double('total_price');
            $table->enum('pet_type', ['DOG', 'CAT']);
            $table->enum('status', ['WAITING', 'PENDING', 'VERIFIED', 'IN_USE', 'COMPLETED', 'CANCELED'])->defualt('WAITING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
