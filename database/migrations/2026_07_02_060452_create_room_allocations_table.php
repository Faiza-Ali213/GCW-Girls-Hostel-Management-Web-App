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
        Schema::create('room_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_name');
            $table->string('room_number');
            $table->string('block')->nullable();
            $table->string('status')->default('active'); // active, inactive, pending
            $table->date('allocation_date')->nullable();
            $table->date('deallocation_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('student_id');
            $table->index('room_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_allocations');
    }
};