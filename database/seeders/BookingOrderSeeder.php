<?php

namespace Database\Seeders;

use App\Models\BookingOrder;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookingData = [
            'room_id' => 1,
            'user_id' => 1,
            'pet_id' => 1,
            'check_in' => '2023-10-17',
            'check_out' => '2023-10-19',
            'pets_amount' => 1,
            'owner_instruction' => 'Please bring a towel',
        ];


        // Calculate total_price
        $room = Room::find($bookingData['room_id']);
        $checkIn = new \DateTime($bookingData['check_in']);
        $checkOut = new \DateTime($bookingData['check_out']);
        $interval = $checkIn->diff($checkOut);
        $totalDays = $interval->days;
        $totalPrice = $room->price * $totalDays;

        // Create the BookingOrder record
        // $bookingOrder = new BookingOrder();
        // $bookingOrder->fill($bookingData);
        // $bookingOrder->pets_amount = 1; // You can set the amount as needed
        // $bookingOrder->total_price = $totalPrice;
        // $bookingOrder->save();
    }
}
