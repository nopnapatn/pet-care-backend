<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookingOrders()
    {
        return $this->belongsToMany(BookingOrder::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
