<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $user_id = User::all()->random()->id;

        $room_type_id = rand(1, 3);
        $roomType = RoomType::find($room_type_id);
        $roomType->available_amount -= 1;
        $roomType->save();

        $room = $roomType->rooms()->where('status', 'AVAILABLE')->first();
        $room->status = 'UNAVAILABLE';
        $room->user_id = $user_id;
        $room->save();

        $pets_amount = rand(1, $roomType->max_pets);

        $check_in = $this->faker->dateTimeBetween('now', '+1 month');
        $check_out = $this->faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
        $nights = $check_in->diff($check_out)->days;
        return [
            'room_number' => $room->number,
            'user_id' => $user_id,
            'check_in' => $check_in->format('Y-m-d'),
            'check_out' => $check_out->format('Y-m-d'),
            'pets_amount' => $pets_amount,
            'total_price' => $roomType->price * $roomType->max_pets * $nights,
            'owner_instruction' => $this->faker->text(100),
        ];
    }
}
