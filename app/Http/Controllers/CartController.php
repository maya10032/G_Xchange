<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

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

    /**
     * cartsテーブルにデータ追加
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        $user = \Auth::user();

        if ($request->input('action') === 'cart') {
            // カートに追加する処理
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->item_id = $request->item_id;
            $cart->count   = $request->count;
            $cart->save();
            $request->session()->flash('cartadd', 'カートに商品を追加しました');
            return back();
        }
    }
}
