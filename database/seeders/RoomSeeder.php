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
        $roomTypes = [
            ['type' => '1', 'start' => 'A'],
            ['type' => '2', 'start' => 'B'],
            ['type' => '3', 'start' => 'C'],
            ['type' => '4', 'start' => 'D'],
            ['type' => '5', 'start' => 'E'],
            ['type' => '6', 'start' => 'F'],
        ];

        foreach ($roomTypes as $roomType) {
            $type = RoomType::where('id', $roomType['type'])->first();
            for ($i = 1; $i <= $type->available_amount; $i++) {
                $room = new Room();
                $room->room_type_id = $roomType['type'];
                $room->number = $roomType['start'] . $i;
                $room->status = 'AVAILABLE';
                $room->save();
            }
        }
    }
}
