<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\BookingController;
use App\Models\BookingOrder;
use App\Models\Enums\BookingOrderStatus;
use App\Models\Enums\RoomStatus;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Database\Factories\BookingOrderFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class BookingOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 40; $i++) {
            $user = User::where('role', 'USER')->inRandomOrder()->first();
            $check_in = $faker->dateTimeBetween('-1 month', '+1 month');
            $check_out = $faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
            $nights = $check_in->diff($check_out)->format('%a');
            $days = $nights + 1;
            $roomType = RoomType::inRandomOrder()->first();

            $bookingOrder = new BookingOrder();
            $bookingOrder->user_id = $user->id;
            $bookingOrder->room_type_id = $roomType->id;
            $bookingOrder->check_in = $check_in->format('Y-m-d');
            $bookingOrder->check_out = $check_out->format('Y-m-d');
            $bookingOrder->pets_amount = $faker->numberBetween(1, $roomType->max_pets);
            $bookingOrder->owner_instruction = $faker->sentence(20);
            $bookingOrder->total_price = $roomType->price * $days;
            $bookingOrder->status = BookingOrderStatus::randomFuture();
            $bookingOrder->save();
        }

        for ($i = 0; $i < 15; $i++) {
            $user = User::where('role', 'USER')->inRandomOrder()->first();
            $check_in = $faker->dateTimeBetween('-1 month', '+1 month');
            $check_out = $faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
            $nights = $check_in->diff($check_out)->format('%a');
            $days = $nights + 1;
            $roomType = RoomType::inRandomOrder()->first();

            $bookingOrder = new BookingOrder();
            $bookingOrder->user_id = $user->id;
            $bookingOrder->room_type_id = $roomType->id;
            $bookingOrder->check_in = $check_in->format('Y-m-d');
            $bookingOrder->check_out = $check_out->format('Y-m-d');
            $bookingOrder->pets_amount = $faker->numberBetween(1, $roomType->max_pets);
            $bookingOrder->owner_instruction = $faker->sentence(20);
            $bookingOrder->total_price = $roomType->price * $days;
            $bookingOrder->room_number = Room::where('room_type_id', $roomType->id)->inRandomOrder()->first()->number;
            $bookingOrder->status = BookingOrderStatus::randomPast();
            $bookingOrder->save();
        }




        // for ($i = 0; $i < 60; $i++) {
        //     $user = User::inRandomOrder()->first();
        //     $roomType = RoomType::where('status', 'AVAILABLE')->inRandomOrder()->first();
        //     $check_in = $faker->dateTimeBetween('-1 month', '+1 month');
        //     $check_out = $faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
        //     $currentDate = now();


        //     $request = [
        //         'user_id' => $user->id,
        //         'room_type_id' => $roomType->id,
        //         'check_in' => $check_in->format('Y-m-d'),
        //         'check_out' => $check_out->format('Y-m-d'),
        //         'pets_amount' => rand(1, $roomType->max_pets),
        //         'pet_type' => $roomType->pet_type,
        //         'owner_instruction' => $faker->text(100),
        //     ];
        //     $bookingOrder = app(BookingController::class)->createBooking($request, $user);

        //     if ($bookingOrder != null) {
        //         if ($currentDate >= $check_in && $currentDate <= $check_out) {
        //             $status = BookingOrderStatus::IN_USE;
        //             // $bookingOrder->room->status = RoomStatus::IN_USE;
        //         } elseif ($currentDate > $check_out) {
        //             $status = BookingOrderStatus::COMPLETED;
        //             $request = Request::create('booking-orders/' . $bookingOrder->id . '/check-out', 'POST', [
        //                 'booking_order_id' => $bookingOrder->id,
        //             ]);
        //         } else {
        //             $status = 'WAITING';
        //         }
        //         $bookingOrder->status = $status;
        //         $bookingOrder->save();
        //     }
        // }
    }
}
