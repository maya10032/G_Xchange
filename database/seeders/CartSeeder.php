<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'user_id' => 1,
                'item_id' => 1,
                'cart_count' => 2
            ],
            [
                'user_id' => 1,
                'item_id' => 2,
                'cart_count' => 4
            ],
            [
                'user_id' => 1,
                'item_id' => 3,
                'cart_count' => 3
            ],
        ]);
    }
}
