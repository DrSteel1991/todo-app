<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = date('Y-m-d H:i:s');

        DB::table('todo')->insert([
        	'user_id' => 1,
            'name' => Str::random(10),
            'description' => Str::random(100),
            'status' => 'completed',
            'date_time' => $now,
            'category' => Str::random(10),
        ]);

        DB::table('todo')->insert([
        	'user_id' => 1,
            'name' => Str::random(10),
            'description' => Str::random(100),
            'status' => 'Snoozed',
            'date_time' => $now,
            'category' => Str::random(10),
        ]);

        DB::table('todo')->insert([
        	'user_id' => 1,
            'name' => Str::random(10),
            'description' => Str::random(100),
            'status' => 'Overdue',
            'date_time' => $now,
            'category' => Str::random(10),
        ]);
    }
}
