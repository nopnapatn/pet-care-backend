<?php

namespace Database\Factories;

use App\Http\Controllers\Api\BookingController;
use App\Models\BookingOrder;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Request;

use SebastianBergmann\Diff\Diff;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingOrder>
 */
class BookingOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $roomType = RoomType::where('status', 'AVAILABLE')->inRandomOrder()->first();
        $check_in = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $check_out = $this->faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
        $currentDate = now();


        $request = [
            'room_type_id' => $roomType->id,
            'check_in' => $check_in->format('Y-m-d'),
            'check_out' => $check_out->format('Y-m-d'),
            'pets_amount' => rand(1, $roomType->max_pets),
            'owner_instruction' => $this->faker->text(100),
        ];
        if ($currentDate >= $check_in && $currentDate <= $check_out) {
            $status = 'CHECKED IN';
        } elseif ($currentDate > $check_out) {
            $status = 'CHECKED OUT';
        } else {
            $status = 'BOOKED';
        }
        $bookingOrder = app(BookingController::class)->createBooking($request, $user);
        return [
            'room_number' => $bookingOrder->room_number,
            'room_type_id' => $bookingOrder->room_type_id,
            'user_id' => $bookingOrder->user_id,
            'check_in' => $bookingOrder->check_in,
            'check_out' => $bookingOrder->check_out,
            'pets_amount' => $bookingOrder->pets_amount,
            'total_price' => $bookingOrder->total_price,
            'owner_instruction' => $bookingOrder->owner_instruction,
            'status' => $bookingOrder->status,
        ];
    }
}
        // if ($roomType->available_amount > 0 && $room) {
        //     $room->status = 'UNAVAILABLE';
        //     $room->user_id = $user->id;
        //     $room->save();

        //     $roomType->available_amount = $roomType->getAvailableRoomsCount();
        //     $roomType->save();
        //     $pets_amount = rand(1, $roomType->max_pets);

        //     // date calculations
        //     $check_in = $this->faker->dateTimeBetween('-1 month', '+1 month');
        //     $check_out = $this->faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
        //     $nights = date_diff($check_in, $check_out)->format('%a');
        //     $nights = $check_in->diff($check_out)->days;

        //     // Check the current date and set the status accordingly
        //     $currentDate = now();
        //     if ($currentDate >= $check_in && $currentDate <= $check_out) {
        //         $status = 'CHECKED IN';
        //     } elseif ($currentDate > $check_out) {
        //         $status = 'CHECKED OUT';
        //     } else {
        //         $status = 'BOOKED';
        //     }
        //     return [
        //         'room_number' => $room->number,
        //         'room_type_id' => $roomType->id,
        //         'user_id' => $user->id,
        //         'check_in' => $check_in->format('Y-m-d'),
        //         'check_out' => $check_out->format('Y-m-d'),
        //         'pets_amount' => $pets_amount,
        //         'total_price' => $roomType->price * $pets_amount * $nights,
        //         'owner_instruction' => $this->faker->text(100),
        //         'status' => $status,
        //     ];
        // }
        // return [];
