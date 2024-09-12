<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'アドミン太郎1',
                'email' => 'admin1@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/09/13'
            ],
            [
                'name' => 'アドミン太郎2',
                'email' => 'admin2@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/09/13'
            ],
            [
                'name' => 'アドミン太郎3',
                'email' => 'admin3@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/09/13'
            ],
        ]);
    }
}
