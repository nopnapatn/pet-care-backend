<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);

        $pet = new Pet();
        $pet->name = 'pet01';
        $pet->age = 1;
        $pet->type = 'dog';
        $pet->breeds = 'husky';
        $user->pets()->save($pet);
        $pet->save();
    }
}
