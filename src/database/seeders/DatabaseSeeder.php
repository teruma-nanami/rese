<?php

namespace Database\Seeders;

use App\Models\CuisineType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminUserSeeder::class,
            AreaSeeder::class,
            CuisineTypeSeeder::class,
            RestaurantSeeder::class,
            ReservationSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
