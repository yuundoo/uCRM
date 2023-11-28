<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'username' => 'test',
            'kana' => 'テスト', // 일본어 발음으로 '테스트'
            'tel' => '0123456789', // 유니크한 전화번호
            'email' => 'test@test.com',
            'password' => Hash::make('password123'),
            'postcode' => '123-4567', // 적절한 포맷의 우편번호
            'address' => 'テスト住所', // 일본어로 '테스트 주소'
            'role' => 'admin',
            'birthday' => '1990-01-01', // 예시 생년월일
            'gender' => 0, // '0'은 남성으로 가정
            'usermemo' => 'これはテストメモです。', // '이것은 테스트 메모입니다.'의 일본어 번역
            // 'rememberToken'은 자동으로 처리됩니다 (일반적으로 로그인 시 생성).
            // 'timestamps'는 Laravel이 자동으로 처리합니다.
        ]);
    }
}
