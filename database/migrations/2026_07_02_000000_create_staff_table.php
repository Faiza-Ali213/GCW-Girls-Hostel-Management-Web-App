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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('name');
            $table->string('role');
            $table->string('phone', 20);
            $table->string('email')->nullable();
            
            // Work Information
            $table->string('duty_shift');
            $table->date('joining_date')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            
            // Address & Contact
            $table->text('address')->nullable();
            
            // Status & Profile
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('profile_picture')->nullable();
            
            // Additional Information
            $table->text('remarks')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};