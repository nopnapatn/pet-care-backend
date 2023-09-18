<?php

namespace Database\Seeders;

use App\Models\Enums\HotelStatus;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room = new Room();
        $room->title = 'Standard Room';
        $room->description = 'This is a standard room for 2 pets.';
        $room->price = 500;
        $room->status = HotelStatus::AVAILABLE;
        $room->available_amount = 20;
        $room->max_pets = 2;
        $room->save();

        $room = new Room();
        $room->title = 'Deluxe Room';
        $room->description = 'This is a deluxe room for 4 pets.';
        $room->price = 1000;
        $room->status = HotelStatus::AVAILABLE;
        $room->available_amount = 10;
        $room->max_pets = 4;
        $room->save();
    }
}
