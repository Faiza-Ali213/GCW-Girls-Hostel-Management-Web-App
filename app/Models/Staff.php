<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'role',
        'phone',
        'duty_shift',
        'email',
        'profile_picture',
        'status',
        'address',
        'joining_date',
        'remarks'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Accessors
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'active' => 'badge bg-success',
            'inactive' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . ' (' . $this->role . ')';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%")
                     ->orWhere('role', 'LIKE', "%{$search}%")
                     ->orWhere('phone', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%");
    }
}