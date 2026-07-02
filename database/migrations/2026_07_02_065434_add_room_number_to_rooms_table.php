<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Add room_number column
            $table->string('room_number')->unique()->after('id');
            
            // Add other columns if missing
            $table->string('block')->nullable()->after('room_number');
            $table->integer('capacity')->default(2)->after('block');
            $table->integer('occupied')->default(0)->after('capacity');
            $table->string('status')->default('available')->after('occupied');
            $table->integer('floor')->nullable()->after('status');
            $table->text('description')->nullable()->after('floor');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('room_number');
            $table->dropColumn('block');
            $table->dropColumn('capacity');
            $table->dropColumn('occupied');
            $table->dropColumn('status');
            $table->dropColumn('floor');
            $table->dropColumn('description');
        });
    }
};