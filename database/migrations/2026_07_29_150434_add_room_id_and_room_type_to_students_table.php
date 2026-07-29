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
        Schema::table('students', function (Blueprint $table) {
            // Add room_id column
            $table->unsignedBigInteger('room_id')->nullable()->after('room_number');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
            
            // Add room_type column
            $table->string('room_type')->nullable()->after('room_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
            $table->dropColumn('room_type');
        });
    }
};