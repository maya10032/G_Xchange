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
     *
     * @param Item $item
     * @return void
     */
    public function showPurchase(Item $item)
    {
        return view('items.purchase', compact('item'));
    }

    /**
     * 購入数を引き継ぎ、確認画面を表示
     *
     * @param Request $request
     * @param Item $item
     * @return void
     */
    public function confirmPurchase(Request $request, Item $item)
    {
        // バリデーション
        $request->validate([
            'count' => 'required|integer|min:1|max:' . $item->count_limit,
        ], [
            'count.required' => '数量を入力してください。',
            'count.integer' => '数量は数字で入力してください。',
            'count.min' => '数量は1以上である必要があります。',
            'count.max' => '一度に購入できるのは ' . $item->count_limit . ' 個までです。',
        ]);
        // 入力値をビューに渡す
        $count = $request->input('count');
        return view('items.purchase', compact('item', 'count'));
    }
}
