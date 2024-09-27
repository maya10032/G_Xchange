<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ItemReview;
use App\Models\Image;
use App\Models\ItemView;
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
        // 販売中がtrueの商品だけ表示
        $items = Item::where('is_active', true)
            ->with('images', 'category')
            ->orderBy('created_at', 'DESC')
            ->paginate(30);

        $categories = Category::limit(5)->get();

        $viewItems = Item::where('is_active', true)
            ->with('images', 'category')
            ->withCount('item_views')
            ->orderBy('item_views_count', 'DESC')
            ->take(5)
            ->get();

        return view('items.index', compact('items', 'viewItems', 'categories'));
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
        $itemReviews = ItemReview::where('item_id', $item->id)
            ->with('user')
            ->get();

        $user = $request->user();
        ItemView::create([
            'item_id' => $item->id,
            'user_id' => $user?->id
        ]);

        return view('items.show', compact('item', 'randomItems', 'user', 'itemReviews'));
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
     * 検索機能
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        $items = Item::where('item_name', 'LIKE', "%{$query}%")
            ->paginate(30);

        $viewItems = Item::where('is_active', true)
            ->with('images', 'category')
            ->withCount('item_views')
            ->orderBy('item_views_count', 'DESC')
            ->take(5)
            ->get();

        $categories = Category::limit(5)->get();

        return view('items.index', compact('items', 'query', 'viewItems', 'categories'));
    }

    /**
     * カテゴリーごとに表示
     *
     * @return void
     */
    public function filterCategory($id)
    {
        $items = Item::where('category_id', $id)->paginate(15);
        $viewItems = Item::where('is_active', true)
            ->with('images', 'category')
            ->withCount('item_views')
            ->orderBy('item_views_count', 'DESC')
            ->take(5)
            ->get();
        $categories = Category::limit(5)->get();
        $selectedCategory = Category::find($id);

        return view('items.index', compact('items', 'viewItems', 'categories', 'selectedCategory'));
    }

    /**
     * カテゴリーごとに表示
     *
     * @return void
     */
    public function saleItem($id)
    {
        $items = Item::where('category_id', $id)->paginate(15);
        $viewItems = Item::where('is_active', true)
            ->with('images', 'category')
            ->withCount('item_views')
            ->orderBy('item_views_count', 'DESC')
            ->take(5)
            ->get();
        $categories = Category::limit(5)->get();
        $selectedCategory = Category::find($id);

        return view('items.index', compact('items', 'viewItems', 'categories', 'selectedCategory'));
    }

    public function review(Request $request, Item $item)
    {
        // バリデーションを追加
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'radio'    => 'required',
            'title'   => 'string|max:255',
            'comment' => 'required|nullable|string',
        ]);
        // dd($request);
        // 商品情報の取得
        $item = Item::find($request->item_id);
        $user = auth()->user();

        // 注文を作成
        $item_review = new ItemReview;
        $item_review->item_id = $request->item_id;
        $item_review->user_id = $user->id;
        $item_review->star    = $request->radio;
        $item_review->title   = $request->title;
        $item_review->comment = $request->comment;
        $item_review->save();
        $request->session()->flash('reviewadd', 'レビューを投稿しました');
        return back();
    }
}
