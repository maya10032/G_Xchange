<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('items')->insert([
            [
                'category_id'   => '1',
                'item_name'     => '商品名1',
                'item_code'     => 'item1',
                'count_limit'   => '10',
                'message'       => '商品説明1',
                'sales_price'   => '100',
                'regular_price' => '1000',
                'created_at'    => '2021/09/13',
            ],
            [
                'category_id'   => '2',
                'item_name'     => '商品名2',
                'item_code'     => 'item2',
                'count_limit'   => '20',
                'message'       => '商品説明2',
                'sales_price'   => '200',
                'regular_price' => '2000',
                'created_at'    => '2021/09/13',
            ],
            [
                'category_id'   => '3',
                'item_name'     => '商品名3',
                'item_code'     => 'item3',
                'count_limit'   => '30',
                'message'       => '商品説明3',
                'sales_price'   => '300',
                'regular_price' => '3000',
                'created_at'    => '2021/09/13',
            ],
        ]);
    }
}
