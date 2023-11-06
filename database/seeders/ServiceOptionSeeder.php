<?php

namespace Database\Seeders;

use App\Models\ServiceOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $optionList1 = [
            // service 1
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Small',
                'title' => 'Short Coat',
                'price' => 30,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Small',
                'title' => 'Long Coat',
                'price' => 35,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'title' => 'Short Coat',
                'price' => 40,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'title' => 'Long Coat',
                'price' => 50,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Large',
                'title' => 'Short Coat',
                'price' => 50,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Large',
                'title' => 'Long Coat',
                'price' => 60,
                'up_price_status' => true,
            ],
        ];

        $optionList2 = [
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Small',
                'title' => 'Trim Only',
                'price' => 45,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Small',
                'title' => 'Complete Cut',
                'price' => 60,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'title' => 'Trim Only',
                'price' => 55,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'title' => 'Complete Cut',
                'price' => 70,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Large',
                'title' => 'Trim Only',
                'price' => 75,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Large',
                'title' => 'Complete Cut',
                'price' => 90,
                'up_price_status' => true,
            ]
        ];

        $optionList3 = [
            [
                'service_id' => 3,
                'title' => 'Brush Out',
                'price' => 10,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'Breath Freshening',
                'price' => 8,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'title' => 'Nail Trim & File',
                'price' => 15,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'Medicated Ear Cleaning',
                'price' => 10,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'title' => 'Flea Bath',
                'price' => 10,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'title' => 'Shed Reducing Treatment',
                'price' => 20,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'De-matting Treatment',
                'price' => 15,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'Paw Polish',
                'price' => 14,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'title' => 'Soft Claws',
                'price' => 25,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'Special Handling',
                'price' => 10,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'Hand Scissoring (15 min)',
                'price' => 20,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'Shave Down',
                'price' => 20,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'NEW!! Coloring – Tail, ears, feet, chest, and mohawk',
                'price' => 15,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'title' => 'NEW!! Feather Extensions',
                'price' => 10,
                'up_price_status' => true,
            ],
        ];

        $all_options = array_merge($optionList1, $optionList2, $optionList3);

        foreach ($all_options as $option) {
            ServiceOption::create($option);
        }
    }
}
