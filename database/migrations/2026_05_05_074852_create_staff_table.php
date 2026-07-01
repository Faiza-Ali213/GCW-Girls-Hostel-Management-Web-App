<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('phone', 20);
            $table->string('duty_shift');
            $table->string('email')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('address')->nullable();
            $table->date('joining_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};