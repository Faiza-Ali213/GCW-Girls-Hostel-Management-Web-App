<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type',
        'capacity',
        'current_occupancy',
        'floor',
        'block',
        'status',
        'notes',
    ];

    /**
     * Get the students assigned to this room.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'room_id');
    }

    /**
     * Get the room allocations for this room.
     */
    public function allocations()
    {
        return $this->hasMany(RoomAllocation::class);
    }

    /**
     * Get active allocations for this room.
     */
    public function activeAllocations()
    {
        return $this->allocations()->where('status', 'active');
    }

    /**
     * Check if room is full.
     */
    public function isFull()
    {
        return $this->current_occupancy >= $this->capacity;
    }

    /**
     * Get available beds count.
     */
    public function availableBeds()
    {
        return $this->capacity - $this->current_occupancy;
    }

    /**
     * Check if room has available beds.
     */
    public function hasAvailableBeds()
    {
        return $this->current_occupancy < $this->capacity;
    }

    /**
     * Get occupancy percentage.
     */
    public function occupancyPercentage()
    {
        if ($this->capacity == 0) {
            return 0;
        }
        return round(($this->current_occupancy / $this->capacity) * 100, 2);
    }

    /**
     * Scope for available rooms.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('current_occupancy', '<', 'capacity');
    }

    /**
     * Scope for full rooms.
     */
    public function scopeFull($query)
    {
        return $query->where('current_occupancy', '>=', 'capacity');
    }

    /**
     * Scope for rooms by block.
     */
    public function scopeByBlock($query, $block)
    {
        return $query->where('block', $block);
    }

    /**
     * Scope for rooms by floor.
     */
    public function scopeByFloor($query, $floor)
    {
        return $query->where('floor', $floor);
    }

    /**
     * Increment occupancy when student is assigned.
     */
    public function incrementOccupancy()
    {
        $this->current_occupancy++;
        if ($this->current_occupancy >= $this->capacity) {
            $this->status = 'full';
        }
        $this->save();
        return $this;
    }

    /**
     * Decrement occupancy when student is removed.
     */
    public function decrementOccupancy()
    {
        $this->current_occupancy--;
        if ($this->current_occupancy < $this->capacity) {
            $this->status = 'available';
        }
        $this->save();
        return $this;
    }
}