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

        $prefectures = [
            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
        ];

        $cuisineTypes = ['寿司', '焼肉', 'ラーメン', 'イタリアン', '居酒屋'];
        
        return [
            'name' => $this->faker->company,
            'post_code' => $this->faker->postcode,
            'address' => $this->faker->city . '' . $this->faker->streetAddress,
            'phone_number' => $this->faker->phoneNumber,
            'image_url' => $this->faker->imageUrl(640, 480, 'food', true, 'Faker'),
            'email' => $this->faker->safeEmail,
            'area' => $this->faker->randomElement($prefectures),
            'cuisine_type' => $this->faker->randomElement($cuisineTypes),
            'detail' => $this->faker->paragraph,
            'owner_id' => User::factory(),
        ];
    }
}
