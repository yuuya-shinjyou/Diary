<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Provider\DateTime;

class RoomClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $results = DB::table('user_rooms')
                    ->select(DB::raw('count(room_id) as count'), 'room_id')
                    ->groupBy('room_id')
                    ->get();

        // dd($results);
        foreach($results as $r){
            DB::table('room_class')->insert([
                'room_id' => $r->room_id,
                'peopleNum' => $r->count,
                'class' => $r->count > 2 ? 2 : 1,
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
