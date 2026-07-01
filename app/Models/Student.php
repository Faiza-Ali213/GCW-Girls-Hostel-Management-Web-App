<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_name',
        'father_name',
        'phone_number',
        'cnic_number',
        'address',
        'email',
        'room_number',
        'date_of_birth',
        'gender',
        'hostel_status',
        'guardian_contact',
        'emergency_contact',
        'profile_picture',
        'admission_date',
        'medical_conditions',
        'remarks'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'admission_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Accessors
    public function getFullNameAttribute(): string
    {
        return $this->student_name . ' (' . $this->father_name . ')';
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->hostel_status) {
            'active' => 'badge bg-success',
            'inactive' => 'badge bg-warning',
            'graduated' => 'badge bg-info',
            'left' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->hostel_status);
    }

    public function getFormattedCnicAttribute(): string
    {
        return $this->cnic_number;
    }

    public function getAgeAttribute(): ?int
    {
        if ($this->date_of_birth) {
            return $this->date_of_birth->age;
        }
        return null;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('hostel_status', 'active');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('student_name', 'LIKE', "%{$search}%")
                     ->orWhere('father_name', 'LIKE', "%{$search}%")
                     ->orWhere('cnic_number', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%")
                     ->orWhere('phone_number', 'LIKE', "%{$search}%");
    }

    public function scopeByRoom($query, $roomNumber)
    {
        return $query->where('room_number', $roomNumber);
    }
}