<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'image_path'];

    public function item()
    {
        // 1つのアイテムに属する
        return $this->belongsTo(Item::class);
    }
}
