<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 画像フォルダが存在しなければ
        if (!Storage::exists('public/images')) {
            // フォルダを作成
            Storage::makeDirectory('public/images');
        }
        return [
            // アップロード時のサイズは固定
            'img_path' => $this->faker->image(storage_path('app/public/images'), 320, 240, null, false)
        ];
    }
}
