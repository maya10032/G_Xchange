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
    public function index()
    {
        $collection = Item::all(); // 全商品を取得
        return view('admin.items.index', ['items' => $collection]);
    }
}
