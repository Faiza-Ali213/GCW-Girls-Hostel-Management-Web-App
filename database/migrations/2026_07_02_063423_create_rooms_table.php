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
            $table->string('room_type');
            $table->integer('total_beds')->default(0);
            $table->integer('occupied_beds')->default(0);
            $table->integer('available_beds')->default(0);
            $table->enum('status', ['available', 'full', 'maintenance'])->default('available');
            $table->decimal('monthly_rent', 10, 2)->nullable();
            $table->text('facilities')->nullable();
            $table->timestamps();
            $table->softDeletes();
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