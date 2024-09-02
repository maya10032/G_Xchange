<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $taxRate = 0.1; // プロパティとして税率を定義

    /**
     * 受注管理一覧ページ作成
     *
     * @return void
     */
    public function index(Item $item)
    {
        //odersテーブルのデータ取得、新しい順で表示
        $orders = Order::with('items')
            // ->where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        // 小計合計の計算
        $ordersWithTax = $orders->map(function ($order) {
            // 小計（税込み）を計算
            // $order->item->sales_price * $order->count;
            $subtotal = $order->items->sales_price * $order->count;
            $order->priceWithTax = $subtotal * (1 + $this->taxRate);
            $order->salesWithTax = $order->items->sales_price * (1 + $this->taxRate);

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
        $order = Order::with(['user', 'items', 'categorys', 'item_images'])->findOrFail($id);
        $subtotal = ($order->items->sales_price * $order->count) * (1 + $this->taxRate);
        // ビューにデータを渡す
        return view('admin.orders.show', compact('order', 'subtotal'));
    }
}
