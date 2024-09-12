<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Image;
use App\Models\ItemsView;
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

        $viewItems = Item::where('is_active', true)
            ->with('images', 'category')
            ->withCount('items_views')
            ->orderBy('items_views_count', 'DESC')
            ->take(5)
            ->get();

        return view('items.index', compact('items', 'viewItems'));
    }

    /**
     * 商品詳細ページ表示
     *
     * @return void
     */
    public function show(Item $item, Request $request)
    {
        // 同じカテゴリーの他の商品をランダムで4件取得、現在の商品は除外
        $randomItems = Item::where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $user = $request->user();
        // if (auth()->user()) {
            ItemsView::create([
                'item_id' => $item->id,
                'user_id' => $user?->id
            ]);
        // }

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

    /**
     * 検索機能
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        $items = Item::where('item_name', 'LIKE', "%{$query}%")
            ->paginate(10);
        return view('items.index', compact('items', 'query'));
    }


    public function view(string $id, Request $request)
    {
        $itemview = Items::find($id);

        $user = $request->user();

        Items::create([
            'item_id' => $id,
            'user_id' => $user?->id
        ]);

        return view('items.index', compact('itemview'));
    }
}
