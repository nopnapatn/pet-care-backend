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
        $roomTypes = [
            ['type' => '1', 'start' => 'A'],
            ['type' => '2', 'start' => 'B'],
            ['type' => '3', 'start' => 'C'],
        ];

        foreach ($roomTypes as $roomType) {
            for ($i = 1; $i <= 10; $i++) {
                $room = new Room();
                $room->room_type_id = $roomType['type'];
                $room->number = $roomType['start'] . $i;
                $room->status = 'AVAILABLE';
                $room->save();
            }
        }
    }
}
