<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrder>
 */
class ServiceOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $service_date = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $pet_type = $this->faker->randomElement(['DOG', 'CAT']);
        $status = "WAITING";

        

        return [
            //
        ];
    }
}
