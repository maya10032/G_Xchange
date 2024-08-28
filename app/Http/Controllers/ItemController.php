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
     * 購入内容確認画面
     *
     * @return void
     */
    public function purchase(Item $item)
    {
        $items = Item::all();
        return view('items.purchase', [
            'items' => $items,
            'item' => $item,
        ]);
    }
}
