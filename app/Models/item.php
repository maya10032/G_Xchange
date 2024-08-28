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

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'item_images')->using(ItemImage::class);
    }
}
