<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;
use App\Models\VisitorDetail;
class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'student_name',
        'student_room',
        'number_of_visitors',
        'visitor_details_json',
        'check_in_time',
        'check_in_by',
        'remarks',
        'visitor_details_json',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'number_of_visitors' => 'integer',
        'visitor_details_json' => 'array',
    ];

    // Relationship with Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Get visitor details as array
    public function getVisitorDetailsAttribute()
    {
        return json_decode($this->visitor_details_json, true) ?? [];
    }

    // Get primary visitor name
    public function getPrimaryVisitorNameAttribute()
    {
        $details = $this->getVisitorDetailsAttribute();
        return $details[0]['visitor_name'] ?? 'Unknown';
    }
}