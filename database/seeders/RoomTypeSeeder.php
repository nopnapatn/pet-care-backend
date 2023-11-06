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
                'available_amount' => 10,
                'max_pets' => 1,
                'start' => 'A'
            ],
            [
                'title' => 'Medium Room',
                'description' => 'Medium room for two pets',
                'price' => 200,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 2,
                'start' => 'B'
            ],
            [
                'title' => 'Large Room',
                'description' => 'Large room for three pets',
                'price' => 300,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 3,
                'start' => 'C'
            ],
            [
                'title' => 'Extra Small Room',
                'description' => 'Cozy room for a single pet',
                'price' => 400,
                'status' => 'AVAILABLE',
                'available_amount' => 10,
                'max_pets' => 1,
                'start' => 'D'
            ],
            [
                'title' => 'Super Suite',
                'description' => 'Luxurious suite for multiple pets',
                'price' => 500,
                'status' => 'AVAILABLE',
                'available_amount' => 5,
                'max_pets' => 5,
                'start' => 'F'
            ],
            [
                'title' => 'Budget Room',
                'description' => 'Economical room for pet owners',
                'price' => 600,
                'status' => 'AVAILABLE',
                'available_amount' => 5,
                'max_pets' => 2,
                'start' => 'G'
            ],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
