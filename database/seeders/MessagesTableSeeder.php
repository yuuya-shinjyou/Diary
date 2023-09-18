<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Provider\DateTime;
use Carbon\Carbon;
use Illuminate\Support\Arr;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 20; // シードしたい回数

        // for ($i = 0; $i < 18; $i++) {
        //     DB::table('users')->insert([
        //         'nickname' => Str::random(5),
        //         'gender' => Arr::random(['male', 'female', 'other']), // ランダムな性別を選択
        //         'avatar' => null, // デフォルト値は null
        //         'todohuken' => null, // デフォルト値は null
        //         'publishing' => false,
        //         'email' => Str::random(4) . '@example.com', // ランダムなメールアドレス
        //         'password' => bcrypt('password'), // デフォルトのパスワードを設定
        //         'created_at' => DateTime::dateTimeThisDecade(),
        //         'updated_at' => now(),
        //     ]);
        // }

        // for ($i = 0; $i < $count; $i++) {
        //     DB::table('rooms')->insert([
        //         'room_name' => Str::random(10),
        //         'created_at' => DateTime::dateTimeThisDecade(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        for ($i = 1; $i < $count; $i++) {
            $length = 30; // 生成する文字列の長さ

            $japaneseCharacters = 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやゆよらりるれろわをん';
    
            $japaneseString = '';
            for ($j = 0; $j < $length; $j++) {
                $randomIndex = rand(0, mb_strlen($japaneseCharacters) - 1);
                $japaneseString .= mb_substr($japaneseCharacters, $randomIndex, 1);
            }

            DB::table('messages')->insert([
                'user_id' => rand(1, 3),
                'room_id' => rand(1, 20),
                'talk' => $japaneseString,
                'stamp' => null,
                'deleted_at' => null,
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // for ($i = 0; $i < 20; $i++) {
        //     DB::table('user_rooms')->insert([
        //         'user_id' => rand(1, 10),
        //         'room_id' => rand(1,20),
        //         'lastread_at' => null,
        //         'created_at' => DateTime::dateTimeThisDecade(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }


    }
}
