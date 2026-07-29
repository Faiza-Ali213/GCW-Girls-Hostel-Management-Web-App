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
        'room_id',      // Add this
        'room_type',    // Add this
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

    // ============================================
    // RELATIONSHIPS
    // ============================================

    /**
     * Get the room associated with the student.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get the fee records for this student.
     */
    public function feeRecords()
    {
        return $this->hasMany(FeeRecord::class, 'student_id');
    }

    /**
     * Get the complaints for this student.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Get the room allocations for this student.
     */
    public function allocations()
    {
        return $this->hasMany(RoomAllocation::class);
    }

    // ============================================
    // ACCESSORS
    // ============================================

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

    /**
     * Get the room type label.
     */
    public function getRoomTypeLabelAttribute(): string
    {
        $types = [
            'double' => 'Double (2 Beds)',
            'triple' => 'Triple (3 Beds)',
            'quad' => 'Quad (4 Beds)',
        ];
        return $types[$this->room_type] ?? 'N/A';
    }

    /**
     * Get the room status with occupancy info.
     */
    public function getRoomStatusAttribute(): string
    {
        if (!$this->room) {
            return 'Not Assigned';
        }
        
        $room = $this->room;
        if ($room->isFull()) {
            return 'Full (' . $room->current_occupancy . '/' . $room->capacity . ')';
        }
        return 'Available (' . $room->current_occupancy . '/' . $room->capacity . ')';
    }

    // ============================================
    // SCOPES
    // ============================================

    /**
     * Scope for active students.
     */
    public function scopeActive($query)
    {
        return $query->where('hostel_status', 'active');
    }

    /**
     * Scope for search functionality.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('student_name', 'LIKE', "%{$search}%")
                     ->orWhere('father_name', 'LIKE', "%{$search}%")
                     ->orWhere('cnic_number', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%")
                     ->orWhere('phone_number', 'LIKE', "%{$search}%")
                     ->orWhere('room_number', 'LIKE', "%{$search}%");
    }

    /**
     * Scope for students by room.
     */
    public function scopeByRoom($query, $roomNumber)
    {
        return $query->where('room_number', $roomNumber);
    }

    /**
     * Scope for students by room type.
     */
    public function scopeByRoomType($query, $roomType)
    {
        return $query->where('room_type', $roomType);
    }

    /**
     * Scope for unallocated students (no room assigned).
     */
    public function scopeUnallocated($query)
    {
        return $query->where(function($q) {
            $q->whereNull('room_number')
              ->orWhere('room_number', '')
              ->orWhere('room_number', 'N/A');
        });
    }

    /**
     * Scope for allocated students (have room assigned).
     */
    public function scopeAllocated($query)
    {
        return $query->whereNotNull('room_number')
                     ->where('room_number', '!=', '')
                     ->where('room_number', '!=', 'N/A');
    }

    /**
     * Scope for students by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('hostel_status', $status);
    }

    /**
     * Scope for students by block (via room relationship).
     */
    public function scopeByBlock($query, $block)
    {
        return $query->whereHas('room', function($q) use ($block) {
            $q->where('block', $block);
        });
    }

    /**
     * Scope for students by floor (via room relationship).
     */
    public function scopeByFloor($query, $floor)
    {
        return $query->whereHas('room', function($q) use ($floor) {
            $q->where('floor', $floor);
        });
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    /**
     * Check if student has a room assigned.
     */
    public function hasRoom(): bool
    {
        return !empty($this->room_number) && $this->room_number !== 'N/A';
    }

    /**
     * Check if student is active.
     */
    public function isActive(): bool
    {
        return $this->hostel_status === 'active';
    }

    /**
     * Get the room details as string.
     */
    public function getRoomDetails(): string
    {
        if (!$this->hasRoom()) {
            return 'Not Assigned';
        }
        return $this->room_number . ' (' . ($this->room_type ?? 'N/A') . ')';
    }

    /**
     * Assign student to a room.
     */
    public function assignRoom($roomId)
    {
        $room = Room::find($roomId);
        if (!$room) {
            return false;
        }

        // Update student
        $this->update([
            'room_id' => $room->id,
            'room_number' => $room->room_number,
            'room_type' => $room->room_type,
        ]);

        // Increment room occupancy
        $room->incrementOccupancy();

        return true;
    }

    /**
     * Remove student from room.
     */
    public function removeFromRoom()
    {
        if ($this->room_id) {
            $room = Room::find($this->room_id);
            if ($room) {
                $room->decrementOccupancy();
            }
        }

        $this->update([
            'room_id' => null,
            'room_number' => null,
            'room_type' => null,
        ]);

        return true;
    }
}