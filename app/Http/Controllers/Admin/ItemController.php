<?php
// 管理者用アイテムコントローラー
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ItemController extends Controller
{
    /**
     * 商品一覧を表示（管理者）
     */
    public function index()
    {
        $collection = Item::all(); // 全商品を取得
        return view('admin.items.index', ['items' => $collection]);
    }

    /**
     * 商品詳細画面を表示（管理者）
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.items.show', ['item' => $item]);
    }
}
