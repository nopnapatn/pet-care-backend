<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getTotalDays()
    {
        $checkIn = new \DateTime($this->check_in);
        $checkOut = new \DateTime($this->check_out);
        $interval = $checkIn->diff($checkOut);
        return $interval->days;
    }

    public function getTotalNights()
    {
        $checkIn = new \DateTime($this->check_in);
        $checkOut = new \DateTime($this->check_out);
        return date_diff($checkIn, $checkOut)->format('%a');
    }
}
