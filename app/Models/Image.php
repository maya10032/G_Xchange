<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function item()
    {
        // 1つのアイテムに属する
        return $this->belongsTo(Item::class);
    }
}
