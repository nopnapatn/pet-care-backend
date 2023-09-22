<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->first_name = 'user01';
        $user->last_name = 'last01';
        $user->email = 'user01@gmail.com';
        $user->password = bcrypt('1234');
        $user->save();
    }
}
