<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function bookingOrders()
    {
        return $this->hasMany(BookingOrder::class);
    }

    
}
