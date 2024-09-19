<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Item;
use App\Models\Image;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $sampleImages = File::files(public_path('dummy_images'));
        $NUM_FAKER = 10;
        $faker = Faker::create('ja_JP');
        $numImagesPerItem = 3;

        $sampleItemNames = [
            '高級腕時計',
            'ショルダーバッグ',
            'レザーシューズ',
            'スマートフォン',
            'ワイヤレスイヤフォン',
            'メンズジャケット',
            '女性用バッグ',
            '家庭用掃除機',
            'エレクトリック自転車',
            'スキンケアセット',
            'スポーツウェア',
            'レディースシューズ',
            'トイレットペーパー',
            '万年筆A型',
            'カードホルダー',
            'システム手帳',
            'ペンケース',
            'インク',
            '多機能ペン',
            'レターオープナー',
            'シザーズ',
            'カラーペンシル',
            'ファウンテンペン',
            'ノックボールペン',
            'ブックダーツ'
        ];


        for ($i = 0; $i < $NUM_FAKER; $i++) {
            $sales_price = $faker->numberBetween(1000, 10000);
            $regular_price = $faker->numberBetween($sales_price, $sales_price * 2);
            $item_name = $sampleItemNames[array_rand($sampleItemNames)];
            $additional_text = $faker->realText(30);


            if ($faker->boolean(70)) {
                $regular_price = $sales_price;
            } else {
                $regular_price = $faker->numberBetween($sales_price, $sales_price * 2);
            }

            $item = Item::create([
                'category_id'   => $faker->numberBetween(1, 4),
                'item_name'     => $item_name . ' - ' . $additional_text,
                'item_code'     => $faker->unique()->numerify('ITEM###'),
                'count_limit'   => $faker->numberBetween(50, 100),
                'sales_price'   => $sales_price,
                'regular_price' => $regular_price,
                'message'       => $faker->realText(150),
                'is_active'     => 1,
                'thumbnail'     => 0,
                'created_at'    => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            $selectedImages = $faker->randomElements($sampleImages, $numImagesPerItem);

            foreach ($selectedImages as $image) {
                $originalName = basename($image);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);

                $imgName = date('YmdHis') . '_' . uniqid() . '.' . $extension;

                Storage::disk('public')->putFileAs('images', $image, $imgName);

                $imageModel = Image::create([
                    'img_path' => $imgName,
                ]);

                $item->images()->attach($imageModel->id);
            }
        }
    }
}
