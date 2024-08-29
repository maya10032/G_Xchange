<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ItemController extends Controller
{
    /**
     * 一覧ページ作成
     *
     * @return void
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', ['items' => $items]);
    }

    /**
     * 商品詳細ページ表示
     *
     * @return void
     */
    public function show(Item $item)
    {
        return view('items.show', [
            'item' => $item,
        ]);
    }

    /**
     * 新規追加フォーム表示
     *
     * @return void
     */
    public function create()
    {
        return view('create');
    }

    /**
     * 購入確認画面の表示
     */
    public function purchase(Item $item)
    {
        // 購入内容確認画面を表示する処理
        return view('items.purchase', compact('item'));
    }

    /**
     * 購入数を引き継ぎ、確認画面を表示
     *
     * @param Request $request
     * @param Item $item
     * @return void
     */
    public function purchaseConfirm(Request $request, Item $item)
    {
        // リクエストから 'count' の値を取得
        $count = $request->input('count'); // リクエストから数量を取得
        // ビューに $item と $count を渡す
        return view('items.purchase', compact('item', 'count'));
    }
}
