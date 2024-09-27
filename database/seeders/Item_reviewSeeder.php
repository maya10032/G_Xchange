<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Item_reviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_reviews')->insert([
            [
                'item_id' => '66',
                'user_id' => 1,
                'stars' => 3,
                'comment' => 'ああああああああああああああああああああああああああああああああああああああああああああああああああ'
            ],
            [
                'item_id' => '66',
                'user_id' => 1,
                'stars' => 3,
                'comment' => 'ああああああああああああああああああああああああああああああああああああああああああああああああああ'
            ],
            [
                'item_id' => '66',
                'user_id' => 1,
                'stars' => 3,
                'comment' => 'ああああああああああああああああああああああああああああああああああああああああああああああああああ'
            ],
        ]);
    }
}
