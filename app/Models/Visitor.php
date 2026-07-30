<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Visitor Personal Information
        'visitor_name',
        'cnic_number',
        'phone_number',
        'email',
        'address',
        
        // Student Visitor Information
        'student_name',
        'student_phone',
        'student_room',
        'student_cnic',
        
        // Visit Details
        'number_of_visitors',
        'purpose_of_visit',
        'relationship_with_student',
        
        // Check-in/Check-out
        'check_in_time',
        'check_out_time',
        'check_in_by',
        'check_out_by',
        
        // Additional Info
        'status',
        'remarks',
        'id_proof_type',
        'id_proof_number',
        
        // Security & Verification
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'verified_at' => 'datetime',
        'is_verified' => 'boolean',
        'number_of_visitors' => 'integer',
    ];

    // ============================================
    // ACCESSORS
    // ============================================

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'active' => 'badge bg-success',
            'checked_out' => 'badge bg-info',
            'cancelled' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getVisitDurationAttribute(): string
    {
        if ($this->check_in_time && $this->check_out_time) {
            return $this->check_in_time->diffForHumans($this->check_out_time);
        }
        return 'Still Active';
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCheckedOut($query)
    {
        return $query->where('status', 'checked_out');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('visitor_name', 'LIKE', "%{$search}%")
                     ->orWhere('cnic_number', 'LIKE', "%{$search}%")
                     ->orWhere('phone_number', 'LIKE', "%{$search}%")
                     ->orWhere('student_name', 'LIKE', "%{$search}%")
                     ->orWhere('student_room', 'LIKE', "%{$search}%");
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isCheckedOut(): bool
    {
        return $this->status === 'checked_out';
    }

    public function checkIn()
    {
        $this->update([
            'status' => 'active',
            'check_in_time' => now(),
            'check_in_by' => auth()->user()->name ?? 'System',
        ]);
    }

    public function checkOut()
    {
        $this->update([
            'status' => 'checked_out',
            'check_out_time' => now(),
            'check_out_by' => auth()->user()->name ?? 'System',
        ]);
    }
}