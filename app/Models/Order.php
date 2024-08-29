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
        // お気に入りはユーザに属している
        return $this->belongsTo(User::class);
    }
}
