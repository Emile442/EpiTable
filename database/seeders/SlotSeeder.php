<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slots')->insert([
            'start_at' => '11:30',
            'end_at' => '12:05'
        ]);
        DB::table('slots')->insert([
            'start_at' => '12:15',
            'end_at' => '12:50'
        ]);
        DB::table('slots')->insert([
            'start_at' => '13:00',
            'end_at' => '13:35'
        ]);
        DB::table('slots')->insert([
            'start_at' => '13:45',
            'end_at' => '14:20'
        ]);
    }
}
