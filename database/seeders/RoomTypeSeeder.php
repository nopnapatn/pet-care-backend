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
                'title' => 'Extra Small Cat Room',
                'description' => 'Tiny room for a single cat',
                'price' => 150,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'CAT',
                'start' => 'A'
            ],
            [
                'title' => 'Small Cat Room',
                'description' => 'Small room for a single cat',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'CAT',
                'start' => 'B'
            ],
            [
                'title' => 'Medium Cat Room',
                'description' => 'Medium room for two cats',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'CAT',
                'start' => 'C'
            ],
            [
                'title' => 'Large Cat Room',
                'description' => 'Large room for three cats',
                'price' => 450,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'CAT',
                'start' => 'D'
            ],
            [
                'title' => 'Luxury Cat Suite',
                'description' => 'Spacious suite for pampered cats',
                'price' => 500,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'CAT',
                'start' => 'E'
            ],
            [
                'title' => 'Spacious Aviary',
                'description' => 'A large aviary for your friends',
                'price' => 1200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 5,
                'pet_type' => 'CAT',
                'start' => 'F'
            ],
            [
                'title' => 'Aquatic Paradise',
                'description' => 'A water wonderland theme for your cats',
                'price' => 1000,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'CAT',
                'start' => 'G'
            ],
            [
                'title' => 'Extra Small Dog Room',
                'description' => 'Tiny room for a single dog',
                'price' => 150,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'DOG',
                'start' => 'H'
            ],
            [
                'title' => 'Small Dog Room',
                'description' => 'Small room for a single dog',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'pet_type' => 'DOG',
                'start' => 'I'
            ],
            [
                'title' => 'Medium Dog Room',
                'description' => 'Medium room for two dogs',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'DOG',
                'start' => 'J'
            ],

            [
                'title' => 'Large Dog Room',
                'description' => 'Large room for three dogs',
                'price' => 450,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'DOG',
                'start' => 'K'
            ],
            [
                'title' => 'Luxury Dog Suite',
                'description' => 'Spacious suite for pampered dogs',
                'price' => 500,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'pet_type' => 'DOG',
                'start' => 'L'
            ],
            [
                'title' => 'Spacious Aviary',
                'description' => 'A large aviary for your friends',
                'price' => 1200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 5,
                'pet_type' => 'DOG',
                'start' => 'M'
            ],
            [
                'title' => 'Aquatic Paradise',
                'description' => 'A water wonderland theme for your dogs',
                'price' => 1000,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'pet_type' => 'DOG',
                'start' => 'N'
            ],

        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
