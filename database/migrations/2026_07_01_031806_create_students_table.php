<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('father_name');
            $table->string('phone_number', 20);
            $table->string('cnic_number', 20)->unique();
            $table->text('address');
            $table->string('email')->nullable();
            $table->string('room_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('female');
            $table->enum('hostel_status', ['active', 'inactive', 'graduated', 'left'])->default('active');
            $table->string('guardian_contact')->nullable();
            $table->text('emergency_contact')->nullable();
            $table->string('profile_picture')->nullable();
            $table->date('admission_date')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};