<?php
// app/Models/FeeRecord.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_name',
        'room_no',
        'phone_number',
        'fee_amount',
        'paid_amount',
        'pending_amount',
        'fee_status',
        'payment_date',
        'payment_method',
        'remarks',
    ];
    protected $casts = [
        'payment_date' => 'date',
        'fee_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'pending_amount' => 'decimal:2',
    ];

    // Status constants
    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_PARTIAL = 'partial';

    public static function getStatuses()
    {
        return [
            self::STATUS_PAID => 'Paid',
            self::STATUS_UNPAID => 'Unpaid',
            self::STATUS_PARTIAL => 'Partial',
        ];
    }

    // Accessor for status badge color
    public function getStatusBadgeColorAttribute()
    {
        return match($this->fee_status) {
            self::STATUS_PAID => 'success',
            self::STATUS_UNPAID => 'danger',
            self::STATUS_PARTIAL => 'warning',
            default => 'secondary',
        };
    }

    // Calculate pending amount automatically
    public function calculatePendingAmount()
    {
        return $this->fee_amount - $this->paid_amount;
    }

    // Boot method to auto-calculate pending amount
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->pending_amount = $model->calculatePendingAmount();
            
            // Auto-update status based on amounts
            if ($model->pending_amount <= 0) {
                $model->fee_status = self::STATUS_PAID;
            } elseif ($model->paid_amount > 0 && $model->pending_amount > 0) {
                $model->fee_status = self::STATUS_PARTIAL;
            } else {
                $model->fee_status = self::STATUS_UNPAID;
            }
        });
    }
}