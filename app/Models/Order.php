<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'count'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function categorys()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function item_images()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
