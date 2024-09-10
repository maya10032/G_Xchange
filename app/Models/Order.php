<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Order extends Model
{
    use HasFactory;
    use Sortable;

    protected $sortable = ['id', 'created_at', 'item_name', 'count', 'item.sales_price', 'user.name', 'created_at'];

    protected $fillable = [
        'user_id',
        'item_id',
        'count'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function category()
    {
        return $this->belongsTo(Item::class, 'category_id');
    }

    public function item_images()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
