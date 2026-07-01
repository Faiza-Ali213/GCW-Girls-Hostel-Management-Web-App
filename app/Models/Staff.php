<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'phone_number',
        'duty_shift',
        'email',
        'address',
        'joining_date',
        'salary',
        'status'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2'
    ];

    // Scope for active staff
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for search
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%")
                     ->orWhere('role', 'LIKE', "%{$search}%")
                     ->orWhere('phone_number', 'LIKE', "%{$search}%");
    }
}