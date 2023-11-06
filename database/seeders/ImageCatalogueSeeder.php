<?php

namespace Database\Seeders;

use App\Models\ImageCatalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageCatalogue = new ImageCatalogue();
        $imageCatalogue->room_type_id = 1;
        $imageCatalogue->image_url = 'room_type-images/room1.jpg';
        $imageCatalogue->save();

        $imageCatalogue = new ImageCatalogue();
        $imageCatalogue->room_type_id = 2;
        $imageCatalogue->image_url = 'room_type-images/room2.jpg';
        $imageCatalogue->save();

        $imageCatalogue = new ImageCatalogue();
        $imageCatalogue->room_type_id = 3;
        $imageCatalogue->image_url = 'room_type-images/room3.jpg';
        $imageCatalogue->save();

        $imageCatalogue = new ImageCatalogue();
        $imageCatalogue->room_type_id = 4;
        $imageCatalogue->image_url = 'room_type-images/room4.jpg';
        $imageCatalogue->save();

        $imageCatalogue = new ImageCatalogue();
        $imageCatalogue->room_type_id = 5;
        $imageCatalogue->image_url = 'room_type-images/room5.jpg';
        $imageCatalogue->save();

        $imageCatalogue = new ImageCatalogue();
        $imageCatalogue->room_type_id = 6;
        $imageCatalogue->image_url = 'room_type-images/room6.jpg';
        $imageCatalogue->save();
    }
}
