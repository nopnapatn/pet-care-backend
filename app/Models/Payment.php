<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_order_id',
        'name',
        'time',
        'date',
        'amount',
    ];

    protected $casts = [
        // 'date' => 'date',
        'amount' => 'float',
    ];

    public function bookingOrder()
    {
        return $this->belongsTo(BookingOrder::class);
    }
}
