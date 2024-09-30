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
        Schema::create('data_brokers', function (Blueprint $table) {
            $table->id();
            $table->decimal('ph', 10, 2);
            $table->decimal('distance_cm', 10, 2);
            $table->decimal('liters_min', 10, 2);
            $table->date('date');
            $table->time('time');
            $table->foreignId('broker_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_brokers');
    }
};
