<?php
// database/migrations/2024_01_01_create_fee_records_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_records', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('room_no');
            $table->string('phone_number');
            $table->enum('fee_status', ['paid', 'unpaid', 'partial'])->default('unpaid');
            $table->decimal('fee_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('pending_amount', 10, 2)->default(0);
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->nullable(); // cash, bank_transfer, etc.
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_records');
    }
};