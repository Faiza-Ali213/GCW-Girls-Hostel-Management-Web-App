<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'icon',
        'link',
        'is_read',
        'read_at',
        'user_id',
        'is_global',
        'expires_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_global' => 'boolean',
        'read_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Relationship with User (if using authentication)
    public function user()
    {
        return $this->belongsTo(User::class);
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

    // Scope for global notifications
    public function scopeGlobal($query)
    {
        return $query->where('is_global', true);
    }

    // Scope for user-specific notifications
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId)->orWhere('is_global', true);
    }

    // Scope for active (not expired) notifications
    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    // Mark as unread
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    // Get notification type badge class
    public function getTypeBadgeClass()
    {
        return match($this->type) {
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'danger',
            default => 'info'
        };
    }

    // Get icon based on type
    public function getIcon()
    {
        if ($this->icon) {
            return $this->icon;
        }

        return match($this->type) {
            'success' => 'bi-check-circle-fill',
            'warning' => 'bi-exclamation-triangle-fill',
            'error' => 'bi-x-circle-fill',
            default => 'bi-info-circle-fill'
        };
    }
}