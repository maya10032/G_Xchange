<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_code',
        'item_name',
        'category_id',
        'count_limit',
        'sales_price',
        'regular_price',
        'message'
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'item_images')->using(ItemImage::class);
    }
}
