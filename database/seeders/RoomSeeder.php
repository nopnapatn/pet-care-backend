<?php

namespace Database\Seeders;

use App\Models\Enums\HotelStatus;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = RoomType::all();

        foreach ($roomTypes as $roomType) {
            // $type = RoomType::where('id', $roomType['type'])->first();
            for ($i = 1; $i <= $roomType->available_amount; $i++) {
                $room = new Room();
                $room->room_type_id = $roomType->id;
                $room->number = $roomType->start . $i;
                $room->status = 'AVAILABLE';
                $room->save();
            }
        }
    }
}
