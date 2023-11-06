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
                'description' => 'Small room for a single cat',
                'price' => 100,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'CAT',
                'start' => 'A'
            ],
            [
                'title' => 'Medium Cat Room',
                'description' => 'Medium room for two cats',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'start' => 'B'
            ],
            [
                'title' => 'Large Cat Room',
                'description' => 'Large room for three cats',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'CAT',
                'start' => 'C'
            ],
            [
                'title' => 'Small Dog Room',
                'description' => 'Small room for a single dog',
                'price' => 100,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'DOG',
                'start' => 'D'
            ],
            [
                'title' => 'Medium Dog Room',
                'description' => 'Medium room for two dogs',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'DOG',
                'start' => 'E'
            ],

            [
                'title' => 'Large Dog Room',
                'description' => 'Large room for three dogs',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'DOG',
                'start' => 'F'
            ],

        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
