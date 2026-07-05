<?php
// database/migrations/2024_01_01_create_visitors_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('id_card_number')->nullable();
            $table->string('purpose_of_visit');
            $table->string('room_no')->nullable();
            $table->string('student_name')->nullable();
            $table->string('student_room')->nullable();
            $table->dateTime('check_in_time');
            $table->dateTime('check_out_time')->nullable();
            $table->string('status')->default('active'); // active, checked_out
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};