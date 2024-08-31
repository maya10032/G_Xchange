<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'item_name',
        'item_code',
        'count_limit',
        'sales_price',
        'regular_price',
        'message'
    ];

    public function images()
    {
        return $this->hasMany(Image::class); // 複数の画像と関連付け（今回は最大４枚）
    }

    public function thumbnail()
    {
        return $this->hasOne(Image::class)->where('is_thumbnail', true); // サムネイル画像のみ取得
    }
}
