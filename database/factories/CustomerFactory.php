<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // '-' 문자를 제거하여 전화번호 생성
        $tel = str_replace('-', '', $this->faker->phoneNumber());

        // 주소의 첫 9문자를 제거
        $address = mb_substr($this->faker->address(), 9);

        return [
            'username' => $this->faker->name,
            'kana' => $this->faker->kanaName,
            'tel' => $tel,
            'email' => $this->faker->email,
            'postcode' => $this->faker->postcode,
            'address' => $address,
            'birthday' => $this->faker->dateTime,
            'gender' => $this->faker->numberBetween(0, 2),
            'usermemo' => $this->faker->realText(50),
        ];
    }
}
