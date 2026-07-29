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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->string('room_type')->nullable(); // e.g., single, double, triple, dormitory
            $table->integer('capacity')->default(2); // Maximum number of students
            $table->integer('current_occupancy')->default(0); // Current number of students
            $table->string('floor')->nullable();
            $table->string('block')->nullable();
            $table->string('status')->default('available'); // available, full, maintenance
            $table->text('description')->nullable();
            $table->json('amenities')->nullable(); // e.g., ["bed", "table", "chair", "fan"]
            $table->decimal('rent_per_month', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};