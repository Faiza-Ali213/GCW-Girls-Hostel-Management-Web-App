<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAllocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
        'student_name',
        'room_number',
        'block',
        'status',          // active, inactive, pending
        'allocation_date',
        'deallocation_date',
        'remarks',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'allocation_date' => 'date',
        'deallocation_date' => 'date',
    ];

    /**
     * Relationship with Student (if Student model exists)
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Relationship with Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_number', 'room_number');
    }
}