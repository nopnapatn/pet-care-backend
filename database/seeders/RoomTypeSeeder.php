<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            [
                'title' => 'Small Room',
                'description' => 'Small room for single pet',
                'price' => 100,
                'status' => 'AVAILABLE',
                'available_amount' => 5,
                'max_pets' => 1,
            ],
            [
                'title' => 'Medium Room',
                'description' => 'Medium room for two pets',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 5,
                'max_pets' => 2,
            ],
            [
                'title' => 'Large Room',
                'description' => 'Large room for three pets',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 5,
                'max_pets' => 3,
            ],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
