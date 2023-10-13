<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookingOrder()
    {
        return $this->belongsTo(BookingOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pets()
    {
        return $this->belongsTo(Pet::class);
    }
}
