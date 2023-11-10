<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = User::where('role', 'USER')->inRandomOrder()->first();
            $service_date = $faker->dateTimeBetween('-1 month', '+1 month');
            $pet_type = $faker->randomElement(['DOG', 'CAT']);
            $status = "PENDING";

            $serviceOrder = new ServiceOrder();

            $servicePackage = ServiceItem::where('type', "package")->inRandomOrder()->first();
            $serviceAlacarte = ServiceItem::where('type', "alacarte")->inRandomOrder()->first();

            $serviceOrder->user_id = $user->id;
            $serviceOrder->service_date = $service_date->format('Y-m-d');

            // Calculate total price from servicePackage and serviceAlacarte prices
            $totalPrice = $servicePackage->price + $serviceAlacarte->price;

            $serviceOrder->total_price = $totalPrice;
            $serviceOrder->pet_type = $pet_type;
            $serviceOrder->status = $status;
            $serviceOrder->save();

            // Attach service items to the service order
            $serviceOrder->serviceItems()->attach([$servicePackage->id, $serviceAlacarte->id]);

            $payment = new Payment();
            $payment->service_order_id = $serviceOrder->id;
            $payment->user_id = $user->id;
            $payment->name = $user->first_name . " " . $user->last_name;
            $payment->amount = $totalPrice; // Use the calculated total price
            $payment->time = $service_date->format('H:i:s');
            $payment->date = $service_date->format('Y-m-d');
            $payment->type = "SERVICE";
            $payment->save();
        }
    }
}
