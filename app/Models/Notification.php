<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'icon',
        'link',
        'user_id',
        'is_global',
        'is_read',
        'read_at',
        'expires_at',
        'is_active'
    ];

    protected $casts = [
        'is_global' => 'boolean',
        'is_read' => 'boolean',
        'is_active' => 'boolean',
        'read_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Scope for active notifications
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope for read notifications
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    // Scope for specific user
    public function scopeForUser($query, $userId)
    {
        return $query->where(function($q) use ($userId) {
            $q->where('is_global', true)
              ->orWhere('user_id', $userId);
        });
    }

    // Mark notification as read
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    // Mark notification as unread
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    // Get the user who owns this notification
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}