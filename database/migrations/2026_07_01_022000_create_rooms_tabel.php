<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->string('floor')->nullable();
            $table->string('building')->nullable();
            $table->integer('total_beds')->default(4);
            $table->integer('occupied_beds')->default(0);
            $table->enum('status', ['available', 'full', 'maintenance'])->default('available');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('room_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->date('allocation_date');
            $table->date('deallocation_date')->nullable();
            $table->enum('status', ['active', 'deallocated'])->default('active');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_allocations');
        Schema::dropIfExists('rooms');
    }
};