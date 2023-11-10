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
                'title' => 'Small Cat Room',
                'description' => 'Small room for a 1 cat',
                'price' => 100,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'CAT',
                'start' => 'A',
                'image_url' => 'http://localhost/images/room-type-images/room1.png'
            ],
            [
                'title' => 'Medium Cat Room',
                'description' => 'Medium room for 2 cats',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'CAT',
                'start' => 'B',
                'image_url' => 'http://localhost/images/room-type-images/room2.png'

            ],
            [
                'title' => 'Large Cat Room',
                'description' => 'Large room for 3 cats',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'CAT',
                'start' => 'C',
                'image_url' => 'http://localhost/images/room-type-images/room3.png'

            ],
            [
                'title' => 'Small Dog Room',
                'description' => 'Small room for a 1 dog',
                'price' => 100,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'DOG',
                'start' => 'D',
                'image_url' => 'http://localhost/images/room-type-images/room1.png'

            ],
            [
                'title' => 'Medium Dog Room',
                'description' => 'Medium room for 2 dogs',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'DOG',
                'start' => 'E',
                'image_url' => 'http://localhost/images/room-type-images/room2.png'

            ],

            [
                'title' => 'Large Dog Room',
                'description' => 'Large room for 3 dogs',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'DOG',
                'start' => 'F',
                'image_url' => 'http://localhost/images/room-type-images/room3.png'

            ],

        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
