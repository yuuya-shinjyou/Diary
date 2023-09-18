<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 中身を削除するとき
        // \App\Models\Message::truncate();
        
        // ダミーデータ生成
        $this->call(MessagesTableSeeder::class);
    }
}
