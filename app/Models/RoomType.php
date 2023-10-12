<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getAvailableRoomsCount()
    {
        return $this->rooms()->where('status', 'AVAILABLE')->count();
    }

    public function hasAvailableRooms()
    {
        return $this->getAvailableRoomsCount() > 0;
    }

    protected $fillable = [
        'title',
        'description',
        'price',
        'available_amount',
        'max_pets',
    ];
}
