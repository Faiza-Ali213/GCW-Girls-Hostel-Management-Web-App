<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorDetail extends Model
{
    use HasFactory;

    protected $table = 'visitor_details';
    
    protected $fillable = [
        'visitor_id',
        'visitor_name',
        'relationship',
        'cnic_number',
        'phone_number',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}