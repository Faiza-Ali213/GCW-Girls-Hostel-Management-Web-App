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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            
            // Visitor Personal Information
            $table->string('visitor_name');
            $table->string('cnic_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            
            // Student Visitor Information
            $table->string('student_name')->nullable();
            $table->string('student_phone')->nullable();
            $table->string('student_room')->nullable();
            $table->string('student_cnic')->nullable();
            
            // Visit Details
            $table->integer('number_of_visitors')->default(1);
            $table->text('purpose_of_visit')->nullable();
            $table->text('relationship_with_student')->nullable();
            
            // Check-in/Check-out
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->string('check_in_by')->nullable();
            $table->string('check_out_by')->nullable();
            
            // Additional Info
            $table->string('status')->default('active'); // active, checked_out, cancelled
            $table->text('remarks')->nullable();
            $table->string('id_proof_type')->nullable(); // CNIC, Passport, etc.
            $table->string('id_proof_number')->nullable();
            
            // Security & Verification
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->string('verified_by')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};