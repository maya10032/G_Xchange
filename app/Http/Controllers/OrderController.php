<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 一覧ページ作成
     *
     * @return void
     */
    public function index()
    {
        //odersテーブルのデータ取得
        $orders = Order::with('item')
            ->where('user_id', \Auth::user()->id)
            ->get();
        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * 購入ボタン押下後、ordersテーブルに登録
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Item $item)
    {
        // バリデーションを追加
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        $order = new Order;
        $order->user_id = Auth::id();
        $order->item_id = $request->item_id;
        $order->count   = $request->count;
        $order->save();
        // 注文完了画面にリダイレクト
        return redirect()->route('orders.complete');
    }

    /**
     * 注文完了画面を表示
     *
     * @return \Illuminate\View\View
     */
    public function complete()
    {
        return view('orders.complete');
    }
}
