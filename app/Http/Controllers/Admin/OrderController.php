<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * 受注管理一覧ページ作成
     *
     * @return void
     */
    public function index(Item $item)
    {
        //odersテーブルのデータ取得、新しい順で表示
        $orders = Order::with('item')
            ->orderBy('created_at', 'DESC')
            ->get();

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
}
