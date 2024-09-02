<?php
// 管理者用アイテムコントローラー
namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Image;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class ItemController extends Controller
{
    /**
     * 商品一覧を表示（管理者）
     */
    public function index()
    {
        $items = Item::all(); // 全商品を取得
        return view('admin.items.index', compact('items'));
    }

    /**
     * 商品詳細画面を表示（管理者）
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.items.show', compact('item'));
    }

    /**
     * 商品新規追加フォーム表示
     *
     * @return void
     */
    public function create()
    {
        // カテゴリーデータを取得
        $categories = Category::all();
        $item = Item::all();
        return view('admin.items.create', compact('item', 'categories'));
    }


    /**
     * 確認画面へ移動
     **/
    function post(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'item_code'     => 'required|string|max:255',
            'item_name'     => 'required|string|max:255',
            'category_id'   => 'required',
            'count_limit'   => 'required|integer',
            'sales_price'   => 'required|integer',
            'regular_price' => 'integer',
            'message'       => 'required|nullable|string',
            'images'        => 'required|array|min:1|max:4',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail'     => 'required|integer|between:0,3',
        ]);

        $categories = Category::all();

        // ファイルパスを保存する配列
        $filePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image) {
                    $filePaths[] = $image->store('images', 'public');
                }
            }
        }
        // シリアライズ可能なデータをセッションに保存
        $sessionData = array_merge($validated, ['file_paths' => $filePaths]);
        // 'UploadedFile' オブジェクトを削除して保存
        unset($sessionData['images']);
        // セッションに保存
        $request->session()->put('item_data', $sessionData);
        // 確認画面にリダイレクト
        return view('admin.items.confirm', [
            'item_data'  => $sessionData,
            'categories' => $categories,
        ]);
    }

    /**
     * 入力内容表示
     *
     * @param Request $request
     * @return void
     */
    public function confirm(Request $request)
    {
        // セッションから値を取り出す
        $input = $request->session()->get('item_data');
        $categories = Category::all();
        // セッションに値が無ければフォームに戻す
        return view('admin.items.confirm', [
            'item_data'  => $input,
            'categories' => $categories,
        ]);
    }


    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        // セッションからデータを取得
        $input = $request->session()->get('item_data');
        if (!$input) {
            return redirect()->route('admin.items.create')->with('error', '無効なアクセスです。');
        }
        // 商品の登録
        $item = Item::create([
            'category_id'   => $input['category_id'],
            'item_name'     => $input['item_name'],
            'item_code'     => $input['item_code'],
            'count_limit'   => $input['count_limit'],
            'sales_price'   => $input['sales_price'],
            'regular_price' => $input['regular_price'],
            'message'       => $input['message'],
            'is_active'     => $request->input('is_active', 1),
        ]);
        // 画像の保存
        foreach ($input['file_paths'] as $index => $path) {
            $item->images()->create([
                'path'         => $path,
                'is_thumbnail' => $index == $input['thumbnail'],
            ]);
        }
        // セッションデータのクリア
        $request->session()->forget('item_data');
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
