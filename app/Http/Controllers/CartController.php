<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        //cartsテーブルのデータ取得
        $carts = Cart::with('item', 'category')
            ->where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        // 合計金額の計算
        $total = $carts->reduce(function ($carry, $cart) {
            $cart->subtotal = $cart->item->tax_sales_prices * $cart->count;
            return $carry + $cart->subtotal;
        }, 0);
        $user = auth()->user();
        $total_count = $carts->sum('count');

        return view('carts.index', compact('carts', 'total', 'total_count', 'user'));
    }

    /**
     * カートに商品追加
     */
    public function store(Request $request, Item $item)
    {
        // バリデーション
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        $action = $request->input('action');

        if ($action === 'cart') {
            $user = auth()->user(); // ログインしているユーザーを取得
            $item_id = $request->input('item_id');
            $count = $request->input('count');

            // 既にカートに同じ商品があるか確認
            $existingCart = Cart::where('user_id', $user->id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingCart) {
                // 既存のカートがあれば数量を増加
                $existingCart->count += $count;
                $existingCart->save();
                $request->session()->flash('cartadd', 'カートに商品を追加しました');
                return back();
            } else {
                // カートに新しいアイテムを追加
                Cart::create([
                    'user_id' => $user->id,
                    'item_id' => $item_id,
                    'count' => $count,
                ]);
                $request->session()->flash('cartadd', 'カートに商品を追加しました');
                return back();
            }
        } elseif ($action === 'purchase') {
            // 購入ページへのリダイレクト
            $count = $request->input('count');
            return view('items.purchase', compact('item', 'count'));
        }
    }

    /**
     * カートの商品削除
     *
     * @param Request $request
     * @return void
     */
    public function destroy($id)
    {
        // cartsテーブルのIDでレコードを取得
        $cart = auth()->user()->cartItems()->wherePivot('id', $id)->first();

        if ($cart) {
            // レコードを削除
            $cart->pivot->delete();

            return redirect()->route('carts.index')->with('cartdelete', 'カートの商品を削除しました');;
        }
    }

    public function checkout(Request $request)
    {
        // カート内の商品情報を取得
        $items = $request->input('items');

        // 合計金額の計算
        $totalAmount = collect($items)->map(function ($item) {
            $itemModel = Item::find($item['item_id']);
            return $itemModel ? $itemModel->tax_sales_prices * $item['count'] : 0;
        })->sum();

        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $charge = \Stripe\Charge::create([
                'amount' => $totalAmount,
                'currency' => 'jpy',
                'source' => $request->input('stripeToken'),
                'description' => 'カート内の商品',
            ]);

            // 注文を作成
            foreach ($items as $item) {
                $order = new Order;
                $order->user_id = auth()->id();
                $order->item_id = $item['item_id'];
                $order->count = $item['count'];
                $order->save();
            }

            // カートを空にする
            Cart::where('user_id', auth()->id())->delete();

            return redirect()->route('orders.complete')->with('success', '決済が完了しました。');
        } catch (\Exception $e) {
            \Log::error('Stripe Error: ' . $e->getMessage());
            return redirect()->route('carts.index')->with('error', '決済処理に失敗しました。');
        }
    }
}
