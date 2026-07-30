<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    // Status Constants
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'student_name',
        'student_email',
        'room_number',
        'contact_number',
        'complaint_by',
        'admin_remark',
        'resolved_at'
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    // Get all statuses
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_RESOLVED => 'Resolved',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    // Get status label
    public function getStatusLabelAttribute()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'status-pending',
            self::STATUS_IN_PROGRESS => 'status-in_progress',
            self::STATUS_RESOLVED => 'status-resolved',
            self::STATUS_REJECTED => 'status-rejected',
            default => 'status-unknown',
        };
    }

    // Get status icon
    public function getStatusIconAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'fa-clock',
            self::STATUS_IN_PROGRESS => 'fa-spinner fa-spin',
            self::STATUS_RESOLVED => 'fa-check-circle',
            self::STATUS_REJECTED => 'fa-times-circle',
            default => 'fa-question-circle',
        };
    }

    // Get priority badge class
    public function getPriorityBadgeAttribute()
    {
        return match($this->priority) {
            'low' => 'priority-low',
            'medium' => 'priority-medium',
            'high' => 'priority-high',
            default => 'priority-unknown',
        };
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    public function scopeResolved($query)
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }
}