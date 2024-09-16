<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 一覧ページ作成
     *
     * @return void
     */
    public function index(Item $item)
    {
        //odersテーブルのデータ取得、新しい順で表示
        $orders = Order::where('user_id', \Auth::user()->id)
            ->with('item', 'category')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // 小計合計の計算
        $ordersWithTax = $orders->map(function ($order) {
            // 小計（税込み）を計算（Itemモデルで計算引き継ぎ）
            $order->subtotal = $order->item->tax_sales_prices * $order->count;
            return $order;
        });

        return view('orders.index', compact('orders', 'ordersWithTax'));
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
        return view('orders.show', compact('order', 'subtotal'));
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
            'stripeToken' => 'required',
        ]);

        // 商品情報の取得
        $item = Item::find($request->item_id);
        $quantity = $request->count;
        $totalPrice = $request->count * $item->tax_sales_prices;

        // if ($totalPrice < 1) {
        //     return back()->withErrors('金額が不正です。');
        // }

        try {
            // StripeのAPIキーを設定
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $charge = \Stripe\Charge::create([
                'amount' => $totalPrice,
                'currency' => 'jpy',
                'description' => $item->item_name,
                'source' => $request->stripeToken,
                'metadata' => [
                    'item_id' => $item->id,
                    'count' => $request->count,
                    'user_id' => auth()->id(),
                ],
            ]);

            // 注文を作成
            $order = new Order;
            $order->user_id = auth()->id();
            $order->item_id = $request->item_id;
            $order->count = $request->count;
            $order->save();

            // 注文完了画面にリダイレクト
            return redirect()->route('orders.complete');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return back()->withErrors(['message' => '決済エラー: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'エラーが発生しました: ' . $e->getMessage()]);
        }
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
