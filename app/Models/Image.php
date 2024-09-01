<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['img_path'];

    public function items()
    {
        // 1つのアイテムに属する
        return $this->belongsToMany(Item::class, 'item_images');
    }
}
