<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemReview;
use Faker\Factory as Faker;

class Item_reviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $NUM_FAKER = 10;
        $faker = Faker::create('ja_JP');
        for ($i = 0; $i < $NUM_FAKER; $i++) {
            ItemReview::create([
                'item_id'    => $faker->numberBetween(1, 70),
                'user_id'    => $faker->numberBetween(1, 10),
                // 'item_code'  => $faker->unique()->numerify('ITEM###'),
                'star'       => $faker->numberBetween("1", "5"),
                'title'      => $faker->realText(20),
                'comment'    => $faker->realText(30, 100),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
            // ItemReview.find_or_create_by(item_id: item_id, user_id: user_id);
        }
    }
}
