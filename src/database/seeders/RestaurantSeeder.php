<?php

// database/seeders/RestaurantSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        Restaurant::factory()->count(30)->create();
    }
}
