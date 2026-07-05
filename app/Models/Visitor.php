<?php
// app/Models/Visitor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_name',
        'phone_number',
        'email',
        'id_card_number',
        'purpose_of_visit',
        'room_no',
        'student_name',
        'student_room',
        'check_in_time',
        'check_out_time',
        'status',
        'remarks'
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_CHECKED_OUT = 'checked_out';

    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_CHECKED_OUT => 'Checked Out',
        ];
    }

    // Accessor for status badge color
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            self::STATUS_ACTIVE => 'success',
            self::STATUS_CHECKED_OUT => 'secondary',
            default => 'secondary',
        };
    }

    // Check if visitor is currently active
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    // Check out visitor
    public function checkout()
    {
        $this->status = self::STATUS_CHECKED_OUT;
        $this->check_out_time = now();
        $this->save();
    }
}