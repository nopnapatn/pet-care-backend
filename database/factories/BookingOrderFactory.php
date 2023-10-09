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
        $user = User::inRandomOrder()->first();
        $roomType = RoomType::where('available_amount', '>', 0)->inRandomOrder()->first();

        $room = $roomType->rooms()->where('status', 'AVAILABLE')->first();

        if ($roomType->available_amount > 0 && $room) {
            $room->status = 'UNAVAILABLE';
            $room->user_id = $user->id;
            $room->save();

            $roomType->available_amount = $roomType->getAvailableRoomsCount();
            $roomType->save();
            $pets_amount = rand(1, $roomType->max_pets);

            // date calculations
            $check_in = $this->faker->dateTimeBetween('now', '+1 month');
            $check_out = $this->faker->dateTimeBetween($check_in->format('Y-m-d') . '+1 days', $check_in->format('Y-m-d') . '+12 days');
            $nights = $check_in->diff($check_out)->days;

            // Update room and room type within a database transaction
            return [
                'room_number' => $room->number,
                'user_id' => $user->id,
                'check_in' => $check_in->format('Y-m-d'),
                'check_out' => $check_out->format('Y-m-d'),
                'pets_amount' => $pets_amount,
                'total_price' => $roomType->price * $pets_amount * $nights,
                'owner_instruction' => $this->faker->text(100),
            ];
        }
        return [];
    }
}
