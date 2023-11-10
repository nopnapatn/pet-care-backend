<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'status',
        'room_number',
        'owner_instruction',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
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