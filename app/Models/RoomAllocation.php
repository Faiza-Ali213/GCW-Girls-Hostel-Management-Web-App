<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'room_id',
        'allocated_at',
        'allocated_by',
        'status', // active, inactive, completed, cancelled
        'check_in_date',
        'check_out_date',
        'notes',
    ];

    protected $casts = [
        'allocated_at' => 'datetime',
        'check_in_date' => 'date',
        'check_out_date' => 'date',
    ];

    /**
     * Get the student for this allocation.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the room for this allocation.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the user who allocated this room.
     */
    public function allocatedBy()
    {
        return $this->belongsTo(User::class, 'allocated_by');
    }

    /**
     * Scope for active allocations.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for completed allocations.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}