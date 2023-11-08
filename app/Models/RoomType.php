<?php

namespace App\Models;

use App\Models\Enums\RoomStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bookingOrders()
    {
        return $this->belongsToMany(BookingOrder::class);
    }

    public function getAvailableRoomsCount()
    {
        return $this->rooms()->where('status', RoomStatus::AVAILABLE)->count();
    }

    public function hasAvailableRooms()
    {
        return $this->getAvailableRoomsCount() > 0;
    }

    public function imageCatalogues()
    {
        return $this->hasMany(ImageCatalogue::class);
    }

    protected $fillable = [
        'title',
        'description',
        'price',
        'available_amount',
        'max_pets',
        'pet_type',
        'start',
    ];
}
