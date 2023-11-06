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
                'furthur_option' => 'Short Coat',
                'price' => 30,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Small',
                'furthur_option' => 'Long Coat',
                'price' => 35,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'furthur_option' => 'Short Coat',
                'price' => 40,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'furthur_option' => 'Long Coat',
                'price' => 50,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Large',
                'furthur_option' => 'Short Coat',
                'price' => 50,
                'up_price_status' => true,
            ],
            [
                'service_id' => 1, // 'Spa Bath Package
                'pet_size' => 'Large',
                'furthur_option' => 'Long Coat',
                'price' => 60,
                'up_price_status' => true,
            ],
        ];

        $optionList2 = [
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Small',
                'furthur_option' => 'Trim Only',
                'price' => 45,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Small',
                'furthur_option' => 'Complete Cut',
                'price' => 60,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'furthur_option' => 'Trim Only',
                'price' => 55,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Medium',
                'furthur_option' => 'Complete Cut',
                'price' => 70,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Large',
                'furthur_option' => 'Trim Only',
                'price' => 75,
                'up_price_status' => true,
            ],
            [
                'service_id' => 2, // 'Spa Bath Package
                'pet_size' => 'Large',
                'furthur_option' => 'Complete Cut',
                'price' => 90,
                'up_price_status' => true,
            ]
        ];

        $optionList3 = [
            [
                'service_id' => 3,
                'furthur_option' => 'Brush Out',
                'price' => 10,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Breath Freshening',
                'price' => 8,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Nail Trim & File',
                'price' => 15,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Medicated Ear Cleaning',
                'price' => 10,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Flea Bath',
                'price' => 10,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Shed Reducing Treatment',
                'price' => 20,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'De-matting Treatment',
                'price' => 15,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Paw Polish',
                'price' => 14,
                'up_price_status' => false, // Assuming it doesn't go up
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Soft Claws',
                'price' => 25,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Special Handling',
                'price' => 10,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Hand Scissoring (15 min)',
                'price' => 20,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'Shave Down',
                'price' => 20,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'NEW!! Coloring – Tail, ears, feet, chest, and mohawk',
                'price' => 15,
                'up_price_status' => true,
            ],
            [
                'service_id' => 3,
                'furthur_option' => 'NEW!! Feather Extensions',
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
