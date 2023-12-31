<?php

namespace Database\Seeders;

use App\Models\ServiceItem;
use App\Models\ServiceOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceItems = [
            // Spa Bath Package
            [
                'service_name' => 'Spa Bath Package',
                'breed_size' => 'Small',
                'option' => 'Short Coat',
                'price' => 1000,
                'type' => 'package',
            ],
            [
                'service_name' => 'Spa Bath Package',
                'breed_size' => 'Small',
                'option' => 'Long Coat',
                'price' => 1200,
                'type' => 'package',
            ],
            [
                'service_name' => 'Spa Bath Package',
                'breed_size' => 'Medium',
                'option' => 'Short Coat',
                'price' => 1500,
                'type' => 'package',
            ],
            [
                'service_name' => 'Spa Bath Package',
                'breed_size' => 'Medium',
                'option' => 'Long Coat',
                'price' => 1800,
                'type' => 'package',
            ],
            [
                'service_name' => 'Spa Bath Package',
                'breed_size' => 'Large',
                'option' => 'Short Coat',
                'price' => 1800,
                'type' => 'package',
            ],
            [
                'service_name' => 'Spa Bath Package',
                'breed_size' => 'Large',
                'option' => 'Long Coat',
                'price' => 2000,
                'type' => 'package',
            ],

            // All-Inclusive Groom Package
            [
                'service_name' => 'All-Inclusive Groom Package',
                'breed_size' => 'Small',
                'option' => 'Trim Only',
                'price' => 1600,
                'type' => 'package',
            ],
            [
                'service_name' => 'All-Inclusive Groom Package',
                'breed_size' => 'Small',
                'option' => 'Complete Cut',
                'price' => 2200,
                'type' => 'package',
            ],
            [
                'service_name' => 'All-Inclusive Groom Package',
                'breed_size' => 'Medium',
                'option' => 'Trim Only',
                'price' => 2000,
                'type' => 'package',
            ],
            [
                'service_name' => 'All-Inclusive Groom Package',
                'breed_size' => 'Medium',
                'option' => 'Complete Cut',
                'price' => 2500,
                'type' => 'package',
            ],
            [
                'service_name' => 'All-Inclusive Groom Package',
                'breed_size' => 'Large',
                'option' => 'Trim Only',
                'price' => 2700,
                'type' => 'package',
            ],
            [
                'service_name' => 'All-Inclusive Groom Package',
                'breed_size' => 'Large',
                'option' => 'Complete Cut',
                'price' => 3200,
                'type' => 'package',
            ],

            // A La Carte Spa Services
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Brush Out',
                'price' => 350,
                'type' => 'alacarte',
            ],
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Breath Freshening',
                'price' => 290,
                'type' => 'alacarte',
            ],
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Nail Trim & File',
                'price' => 500,
                'type' => 'alacarte',
            ],
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Medicated Ear Cleaning',
                'price' => 350,
                'type' => 'alacarte',
            ],
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Flea Bath',
                'price' => 350,
                'type' => 'alacarte',
            ],
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Shed Reducing Treatment',
                'price' => 700,
                'type' => 'alacarte',
            ],
            // [
            //     'service_id' => 3,
            //     'option' => 'De-matting Treatment',
            //     'price' => 15,
            //     'up_price_status' => true,
            // ],
            [
                'service_name' => 'A La Carte Spa Services',
                'option' => 'Paw Polish',
                'price' => 500,
                'type' => 'alacarte',
            ],
            // [
            //     'service_id' => 3,
            //     'option' => 'Soft Claws',
            //     'price' => 25,
            //     'up_price_status' => true,
            // ],
            // [
            //     'service_id' => 3,
            //     'furthur_option' => 'Special Handling',
            //     'price' => 10,
            //     'up_price_status' => true,
            // ],
            // [
            //     'service_id' => 3,
            //     'furthur_option' => 'Hand Scissoring (15 min)',
            //     'price' => 20,
            //     'up_price_status' => true,
            // ],
            // [
            //     'service_id' => 3,
            //     'furthur_option' => 'Shave Down',
            //     'price' => 20,
            //     'up_price_status' => true,
            // ],
            // [
            //     'service_id' => 3,
            //     'furthur_option' => 'NEW!! Coloring – Tail, ears, feet, chest, and mohawk',
            //     'price' => 15,
            //     'up_price_status' => true,
            // ],
            // [
            //     'service_id' => 3,
            //     'furthur_option' => 'NEW!! Feather Extensions',
            //     'price' => 10,
            //     'up_price_status' => true,
            // ],
        ];

        foreach ($serviceItems as $serviceItem) {
            ServiceItem::create($serviceItem);
        }
    }
}
