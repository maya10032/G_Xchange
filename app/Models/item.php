<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Item extends Model
{
    use HasFactory,Sortable;

    protected $sortable = ['id', 'item_name', 'item_code', 'is_active', 'sales_price', 'created_at', 'updated_at', 'category_name', 'discount_price'];

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
        'message',
        'is_active',
        'thumbnail',
        'created_at'
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
        return $this->belongsToMany(Order::class); // 中間テーブルがある場合
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTaxSalesPricesAttribute()
    {
        $taxRate = 0.1; // 税率10%
        return round($this->sales_price * (1 + $taxRate));
        // $item->tax_sales_pricesでとれるようになる
    }

    public function getTaxRegularPricesAttribute()
    {
        $taxRate = 0.1; // 税率10%
        return round($this->regular_price * (1 + $taxRate));
        // $item->tax_regular_pricesでとれるようになる
    }

    public function item_views()
    {
        return $this->hasMany(ItemView::class);
    }

    // レビューテーブル
    public function reviews() {

        return $this->hasMany(ItemReview::class);

    }
}
