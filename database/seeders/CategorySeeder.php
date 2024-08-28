<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => '食品'
            ],
            [
                'category_name' => '飲料'
            ],
            [
                'category_name' => '日用雑貨'
            ],
            [
                'category_name' => '文房具'
            ],
        ]);
    }
}
