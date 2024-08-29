<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        //cartsテーブルのデータ取得
        $carts = Cart::with('item')
            ->where('user_id', \Auth::user()->id)
            ->get();
        return view('carts.index', compact('carts'));
    }

    public function handleAction(Request $request, Item $item)
    {
        // バリデーション
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1|max:' . $item->count_limit,
        ], [
            'count.required' => '数量を入力してください。',
            'count.integer'  => '数量は数字で入力してください。',
            'count.min'      => '数量は1以上である必要があります。',
            'count.max'      => '一度に購入できるのは ' . $item->count_limit . ' 個までです。',
        ]);

        $action = $request->input('action');

        if ($action === 'cart') {
            // カートに追加する処理
            $cart          = new Cart;
            $cart->user_id = Auth::id();
            $cart->item_id = $request->item_id;
            $cart->count   = $request->count;
            $cart->save();

            $request->session()->flash('cartadd', 'カートに商品を追加しました');
            return back();
        } elseif ($action === 'purchase') {
            // 購入ページへのリダイレクト
            $count = $request->input('count');
            // return redirect()->route('items.purchase', ['item' => $item->id]);
            return view('items.purchase', compact('item', 'count'));
        }
    }
}
