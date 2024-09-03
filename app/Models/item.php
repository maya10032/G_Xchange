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
        return $this->belongsToMany(Image::class, 'item_images')->using(ItemImage::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(Image::class)->where('is_thumbnail', true); // サムネイル画像のみ取得
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class); // 中間テーブルがある場合 }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
