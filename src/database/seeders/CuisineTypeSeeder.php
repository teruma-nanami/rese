<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CuisineType;

class CuisineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CuisineType::create([
            'name' => '寿司',
        ]);
        CuisineType::create([
            'name' => '焼肉',
        ]);
        CuisineType::create([
            'name' => '居酒屋',
        ]);
        CuisineType::create([
            'name' => 'イタリアン',
        ]);
        CuisineType::create([
            'name' => 'ラーメン',
        ]);
    }
}
