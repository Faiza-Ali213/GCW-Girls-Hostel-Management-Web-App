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
        'allocation_date',
        'deallocation_date',
        'status',
        'remarks'
    ];

    protected $casts = [
        'allocation_date' => 'date',
        'deallocation_date' => 'date'
    ];

    /**
     * Get the student for this allocation
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the room for this allocation
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope for active allocations
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for deallocated
     */
    public function scopeDeallocated($query)
    {
        return $query->where('status', 'deallocated');
    }

    /**
     * Check if allocation is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Deallocate this student
     */
    public function deallocate()
    {
        $this->status = 'deallocated';
        $this->deallocation_date = now();
        $this->save();
        
        // Update room status
        $this->room->updateStatus();
    }
}