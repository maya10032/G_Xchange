<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 購入履歴一覧ページ作成
     *
     * @return void
     */
    public function index()
    {
        $items = \Auth::user()->OrderItems()->orderBy('created_at', 'desc')->get();
        return view('orders.index', ['items' => $items]);
    }

    /**
     * 購入ボタン押下後、ordersテーブルに登録
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        // バリデーションを追加
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        // 認証済みユーザー
        $user = \Auth::user();

        $order = new Order;
        $order->user_id = $user->id;
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
