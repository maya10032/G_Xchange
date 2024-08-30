<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $taxRate = 0.1; // プロパティとして税率を定義

    public function index()
    {
        //cartsテーブルのデータ取得
        $carts = Cart::with('item')
            ->where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        // 合計金額の計算
        $total = $carts->reduce(function ($carry, $cart) {
            $subtotal = $cart->item->sales_price * $cart->count;
            $priceWithTax = $subtotal * (1 + $this->taxRate);
            return $carry + $priceWithTax;
        }, 0);

        return view('carts.index', compact('carts', 'total'));
    }

    /**
     * 同じ
     */
    public function store(Request $request, Item $item)
    {
        // バリデーション
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1|max:' . $item->count_limit,
        ], [
            'count.required' => '数量を入力してください。',
            'count.integer'  => '数量は数字で入力してください。',
            'count.min'      => '数量は1以上である必要があります。',
            'count.max'      => '一度に購入できる数を超えています。',
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
            return redirect()->route('carts.index')->with('deleted', 'カートから商品を削除しました。');
        }
    }
}
