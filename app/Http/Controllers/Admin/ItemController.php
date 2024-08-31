<?php
// 管理者用アイテムコントローラー
namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Http\Controllers\Controller;
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

    /**
     * 商品新規追加フォーム表示
     *
     * @return void
     */
    public function create()
    {
        return view('admin.items.create', ['item' => new Item()]);
    }

    /**
     * 新規登録
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'images'    => 'required|array|min:1|max:4', // 最大４枚
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 画像ファイルのバリデーション
            'thumbnail' => 'required|integer|between:0,3', // サムネイルの選択
        ], [
            // 'count.required' => '数量を入力してください。',
            // 'count.integer'  => '数量は数字で入力してください。',
            // 'count.min'      => '数量は1以上である必要があります。',
            // 'count.max'      => '一度に購入できる数を超えています。',
        ]);

        // 商品の登録
        $item = Item::create(['item_name' => $request->item_name]);

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('images', 'public'); // 画像を保存

            $item->images()->create([
                'path' => $path,
                'is_thumbnail' => $index == $request->thumbnail, // サムネイルの設定
            ]);
        }

        return redirect()->route('admin.items.index')->with('success', '商品が作成されました。');
    }
    /**
     * 商品編集画面を表示（管理者）
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.items.cere', ['item' => $item]);
    }
}
