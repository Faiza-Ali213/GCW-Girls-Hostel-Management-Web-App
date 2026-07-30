<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_name',
        'student_phone',
        'student_room',
        'student_cnic',
        'number_of_visitors',
        'purpose_of_visit',
        'relationship_with_student',
        'check_in_time',
        'check_in_by',
        'remarks',
        'id_proof_type',
        'id_proof_number',
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'verified_at' => 'datetime',
        'is_verified' => 'boolean',
        'number_of_visitors' => 'integer',
    ];

    // RELATIONSHIP WITH VISITOR DETAILS
    public function visitorDetails()
    {
        return $this->hasMany(VisitorDetail::class);
    }

    // Get primary visitor
    public function getPrimaryVisitorAttribute()
    {
        return $this->visitorDetails->first();
    }

    // Get all visitor names as comma separated
    public function getVisitorNamesAttribute()
    {
        return $this->visitorDetails->pluck('visitor_name')->implode(', ');
    }

    // Scopes
    public function scopeSearch($query, $search)
    {
        return $query->where('student_name', 'LIKE', "%{$search}%")
                     ->orWhere('student_room', 'LIKE', "%{$search}%")
                     ->orWhereHas('visitorDetails', function($q) use ($search) {
                         $q->where('visitor_name', 'LIKE', "%{$search}%")
                           ->orWhere('cnic_number', 'LIKE', "%{$search}%")
                           ->orWhere('phone_number', 'LIKE', "%{$search}%");
                     });
    }
    // Add this accessor to get visitor details as array
public function getVisitorDetailsListAttribute()
{
    return json_decode($this->visitor_details_json, true) ?? [];
}

// Add this mutator to set visitor details
public function setVisitorDetailsListAttribute($value)
{
    $this->attributes['visitor_details_json'] = json_encode($value);
}
}