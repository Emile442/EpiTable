<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@epitech.eu',
            'school' => '0',
            'role' => 'ADMIN',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'student',
            'lastname' => 'student',
            'email' => 'student@epitech.eu',
            'school' => '0',
            'role' => 'USER',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
        ]);
    }
}
