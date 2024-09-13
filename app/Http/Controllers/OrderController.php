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

    // public function create()
    // {
    //     return view('orders.create');
    // }

    // public function pay(StorePaymentRequest $request)
    // {
    //     \Stripe\Stripe::setApiKey(config('stripe.stripe_secret_key'));

    //     try {
    //         \Stripe\Charge::create([
    //             'source' => $request->stripeToken,
    //             'amount' => 1000,
    //             'currency' => 'jpy',
    //         ]);
    //     } catch (Exception $e) {
    //         return back()->with('flash_alert', '決済に失敗しました！('. $e->getMessage() . ')');
    //     }
    //     return redirect()->route('orders.store');
    // }

    /**
     * 購入ボタン押下後、ordersテーブルに登録
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Item $item)
    {
        $action = $request->input('action');
        if ($action === 'allbuy') {
            $user = Auth::user();
            $cartItems = $user->cartItems;
            foreach ($cartItems as $cartItem) {
                Order::create([
                    'user_id' => $user->id,
                    'item_id' => $cartItem->id,
                    'count'   => $cartItem->pivot->count, // カートの数量を使用（中間テーブルのフィールドにアクセス）
                ]);
            }

            // カートを空にする
            $user->cartItems()->detach();

            // 注文完了画面にリダイレクト
            return redirect()->route('orders.complete');
        } else {
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
