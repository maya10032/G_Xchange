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
        $categories = Category::withCount('items')->paginate(10);
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
            'category_name' => 'required|string|max:255',
        ]);
        // カテゴリーの新規作成
        $category = new Category();
        $category->category_name = $validated['category_name'];
        $category->save();
        // 成功時のリダイレクト
        return redirect()->route('admin.categories.index')->with('attention', 'カテゴリーが作成されました。');
    }
}
