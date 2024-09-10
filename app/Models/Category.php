<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory;
    use Sortable;

    protected $sortable = ['id', 'category_name', 'items_count', 'created_at', 'updated_at'];

    public function itemsCountSortable($query, $direction)
    {
        return $query->leftJoin('items', 'items.category_id', '=', 'categories.id')
            ->select('categories.id', 'categories.category_name', 'categories.created_at', 'categories.updated_at')
            ->selectRaw('COUNT(items.id) as items_count')
            ->groupBy('categories.id', 'categories.category_name', 'categories.created_at', 'categories.updated_at')
            ->orderByRaw('items_count ' . $direction);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'category_name',
        'category_id',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
