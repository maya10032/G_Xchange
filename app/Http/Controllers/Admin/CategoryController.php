<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリー一覧
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::withCount('items')->sortable()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * カテゴリー新規登録画面
     *
     * @return void
     */
    public function create()
    {
        $nextId = Category::max('id') + 1;
        return view('admin.categories.create', compact('nextId'));
    }

    /**
     * 新規登録処理
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories',
        ]);
        // カテゴリーの新規作成
        $category = new Category();
        $category->category_name = $validated['category_name'];
        $category->save();
        // 成功時のリダイレクト
        return redirect()->route('admin.categories.index')->with('create', 'カテゴリーが作成されました。');
    }

    /**
     * カテゴリー編集画面
     *
     * @param [type] $book_id
     * @return void
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * 変更処理
     *
     * @param Request $request
     * @param Category $category
     * @return void
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        // バリデーション
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories',
        ]);
        // カテゴリーの更新
        $category->category_name = $validated['category_name'];
        $category->save();
        // 成功時のリダイレクト
        return redirect()->route('admin.categories.index')->with('success', 'カテゴリーが正常に更新されました。');
    }

    /**
     * カテゴリー削除
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        // カテゴリー情報を取得
        $category = Category::findOrFail($id);
        // カテゴリーを削除
        $category->delete();
        // リダイレクト
        return redirect()->route('admin.categories.index')->with('delete', '商品が削除されました。');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $categories = Category::where('category_name', 'LIKE', "%{$query}%")
        ->paginate(10);

        return view('admin.categories.index', compact('categories', 'query'));
    }
}
