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
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                
                // Notification content
                $table->string('title');
                $table->text('message');
                $table->string('type')->default('info'); // info, success, warning, error
                $table->string('icon')->nullable();
                $table->string('link')->nullable();
                
                // User association
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->boolean('is_global')->default(false);
                
                // Read status
                $table->boolean('is_read')->default(false);
                $table->timestamp('read_at')->nullable();
                
                // Expiration and activity
                $table->timestamp('expires_at')->nullable();
                $table->boolean('is_active')->default(true);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes for better performance
                $table->index(['user_id', 'is_read', 'is_active']);
                $table->index(['is_global', 'is_read', 'is_active']);
                $table->index(['type']);
                $table->index(['expires_at']);
                $table->index(['created_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};