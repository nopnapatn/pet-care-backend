<?php

namespace Database\Seeders;

use App\Models\Enums\ServiceType;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceList = [
            [
                'title' => 'Spa Bath Package',
                'description' => 'Our Spa Bath package includes detailed cleansing and a luxurious shampoo massage & blueberry facial followed by a conditioning rinse or spray. Once cleaned and conditioned, your pet is blow dried and brushed to reveal their soft, silky coat. This package also includes a nail trim and file, ear cleaning, and anal glad expression (if necessary).',
                'type' => ServiceType::PACKAGE,
            ],
            [
                'title' => 'All-Inclusive Groom Package',
                'description' => 'Our All-Inclusive Groom package includes detailed cleansing, a luxurious and relaxing shampoo massage & blueberry facial followed by a conditioning rinse or spray.   Your pet’s coat is then blow dried, brushed out, cut & styled . This package also includes a nail trim and file, ear cleaning, and anal glad expression (if necessary).',
                'type' => ServiceType::PACKAGE,
            ],
            [
                'title' => 'A La Carte Spa Services',
                'type' => ServiceType::ALACARTE,
            ],
        ];

        foreach ($serviceList as $service) {
            Service::create($service);
        }
    }
}
