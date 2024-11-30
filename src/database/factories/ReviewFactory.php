<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = \App\Models\Review::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'restaurant_id' => $this->faker->numberBetween(1, 20),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional()->paragraph(),
            'review_date' => $this->faker->date(),
        ];
    }
}

