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

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeDeallocated($query)
    {
        return $query->where('status', 'deallocated');
    }
}