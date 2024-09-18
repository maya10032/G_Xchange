<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 受注管理一覧ページ作成
     *
     * @return void
     */
    public function index(Request $request)
    {
        $sort      = $request->get('sort', 'orders.id'); // デフォルトはordersテーブル
        $direction = $request->get('direction', 'asc');
        $sortable = [
            'id',
            'created_at',
            'item_name',
            'count',
            'item.sales_price',
            'user.name',
        ];

        // デフォルトはordersテーブル
        if (!in_array($sort, $sortable)) {
            $sort = 'orders.id';
        }
        $orders = Order::with('item', 'user')
            ->orderBy($sort, $direction)
            ->paginate(10);

        // 小計合計の計算
        $ordersWithTax = $orders->map(function ($order) {
            $order->subtotal = $order->item->tax_sales_prices * $order->count;
            return $order;
        });

        return view('admin.orders.index', compact('orders', 'ordersWithTax'));
    }

    /**
     * 商品詳細ページ表示
     *
     * @return void
     */
    public function show($id)
    {
        // 注文IDに基づいて注文を取得
        $order = Order::with(['user', 'item', 'category', 'item_images'])->findOrFail($id);
        $subtotal = $order->item->tax_sales_prices * $order->count;
        // ビューにデータを渡す
        return view('admin.orders.show', compact('order', 'subtotal'));
    }

    /**
     * 検索機能
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        $orders = Order::with(['item', 'user'])
            ->whereHas('item', function ($q) use ($query) {
                $q->where('item_name', 'LIKE', "%{$query}%");
            })
            ->orwhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->paginate(10);
        $ordersWithTax = $orders->map(function ($order) {
            $order->subtotal = $order->item->tax_sales_prices;
            $order->regtotal = $order->item->tax_regular_prices;
            return $order;
        });
        return view('admin.orders.index', compact('orders', 'ordersWithTax', 'query'));
    }
}
