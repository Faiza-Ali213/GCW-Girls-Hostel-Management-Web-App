<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'room_number',
        'block',
        'capacity',
        'occupied',
        'status',        // available, occupied, maintenance
        'floor',
        'description',
    ];

    /**
     * Relationship: A room has many allocations.
     */
    public function allocations()
    {
        return $this->hasMany(RoomAllocation::class, 'room_number', 'room_number');
    }
}