<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ItemController extends Controller
{

    protected $taxRate = 0.1; // プロパティとして税率を定義

    /**
     * 一覧ページ作成
     *
     * @return void
     */
    public function index()
    {
        // 販売中がtrueの商品だけ表示
        $items = Item::where('is_active', true)
            ->with('images', 'category')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        // ->get();
        return view('items.index', compact('items'));
    }

    /**
     * 商品詳細ページ表示
     *
     * @return void
     */
    public function show(Item $item)
    {
        // 同じカテゴリーの他の商品をランダムで4件取得、現在の商品は除外
        $randomItems = Item::where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('items.show', compact('item', 'randomItems'));
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
        return view('items.purchase', compact('item', 'randomItems'));
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
