<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stylelist>
 */
class StylelistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 임시 태그 배열 생성
        $tags = ['男性ヘア', '女性ヘア', 'キズヘア', 'カラー', 'パーマ', 'マッシュ'];

        // 랜덤 태그 선택
        $randomTags = collect($tags)->random(rand(1, count($tags)))->toArray();
        return [
            'name' => $this->faker->name,
            // 임의의 이미지 URL 생성을 위해 placeholder.com 서비스 사용
            'profile_image' => $this->faker->randomElement([
                'https://randomuser.me/api/portraits/men/1.jpg',
                'https://randomuser.me/api/portraits/women/1.jpg',
                'https://randomuser.me/api/portraits/men/2.jpg',
                'https://randomuser.me/api/portraits/women/2.jpg',
                'https://randomuser.me/api/portraits/men/3.jpg',
                'https://randomuser.me/api/portraits/women/3.jpg',
                'https://randomuser.me/api/portraits/men/4.jpg',
                'https://randomuser.me/api/portraits/women/4.jpg',
                'https://randomuser.me/api/portraits/men/5.jpg',
                'https://randomuser.me/api/portraits/women/5.jpg',
                // 필요하다면 더 많은 이미지 URL을 추가할 수 있습니다.
            ]),
            'description' => $this->faker->realText(50),
            'review_count' => $this->faker->numberBetween(30, 500), // 0부터 500 사이의 숫자
            'average_rating' => $this->faker->randomFloat(2, 3, 5), // 0부터 5까지의 소수점 2자리 실수
            'tags' => $randomTags,
        ];
    }
}
