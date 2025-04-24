<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'restaurant_id' => $this->faker->numberBetween(1, 20),
            'reservation_date' => $this->faker->date(),
            'reservation_time' => $this->faker->time(),
            'number_of_people' => $this->faker->numberBetween(1, 10),
            'special_requests' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
        ];
    }
}
