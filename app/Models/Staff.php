<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    
    protected $fillable = [
        'name',
        'role',
        'phone_number',
        'duty_shift',
        'email',
        'address',
        'joining_date',
        'salary',
        'profile_image',
        'status',
        'notes'
    ];

    // Accessor for duty shift display
    public function getDutyShiftAttribute($value)
    {
        $shifts = [
            'morning' => 'Morning (8 AM - 4 PM)',
            'evening' => 'Evening (4 PM - 12 AM)',
            'night' => 'Night (12 AM - 8 AM)',
            'full_day' => 'Full Day',
            'part_time' => 'Part Time'
        ];
        
        return $shifts[$value] ?? $value;
    }

    // Mutator for duty shift
    public function setDutyShiftAttribute($value)
    {
        $shifts = [
            'Morning (8 AM - 4 PM)' => 'morning',
            'Evening (4 PM - 12 AM)' => 'evening',
            'Night (12 AM - 8 AM)' => 'night',
            'Full Day' => 'full_day',
            'Part Time' => 'part_time'
        ];
        
        $this->attributes['duty_shift'] = $shifts[$value] ?? $value;
    }
}