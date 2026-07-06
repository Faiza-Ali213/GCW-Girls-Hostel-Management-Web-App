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
        Schema::table('rooms', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('rooms', 'available_beds')) {
                $table->integer('available_beds')->default(0)->after('status');
            }
            if (!Schema::hasColumn('rooms', 'occupied_beds')) {
                $table->integer('occupied_beds')->default(0)->after('available_beds');
            }
            if (!Schema::hasColumn('rooms', 'total_beds')) {
                $table->integer('total_beds')->default(0)->after('occupied_beds');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['available_beds', 'occupied_beds', 'total_beds']);
        });
    }
};