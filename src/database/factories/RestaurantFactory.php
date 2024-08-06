<?php

// database/factories/RestaurantFactory.php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'image_url' => $this->faker->imageUrl(640, 480, 'food', true, 'Faker'),
            'email' => $this->faker->safeEmail,
            'area' => $this->faker->city,
            'cuisine_type' => $this->faker->word,
            'owner_id' => User::factory(),
        ];
    }
}
