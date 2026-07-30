<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'student_name',
        'room_number',
        'contact_number',
        'student_email',
        'complaint_by',
        'admin_remark',
        'resolved_at'
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    // Scope for pending complaints
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for in-progress complaints
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    // Scope for resolved complaints
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'badge bg-warning',
            'in_progress' => 'badge bg-info',
            'resolved' => 'badge bg-success',
            'rejected' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }

    // Get priority badge class
    public function getPriorityBadgeAttribute()
    {
        return match($this->priority) {
            'low' => 'badge bg-success',
            'medium' => 'badge bg-warning',
            'high' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }
}