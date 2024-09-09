<?php
// 管理者用アイテムコントローラー
namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Image;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    private $taxRate = 0.1; // プロパティとして税率を定義
    private $validator = [
        'item_code'     => 'required|string|max:255',
        'item_name'     => 'required|string|max:255',
        'category_id'   => 'required',
        'count_limit'   => 'required|integer',
        'sales_price'   => 'required|integer',
        'regular_price' => 'integer',
        'message'       => 'required|nullable|string',
        // 'files.*'       => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'files'         => 'required|array|min:1|max:4'
    ];

    /**
     * 商品一覧を表示（管理者）
     */
    public function index()
    {
        $items = Item::with('category')->paginate(10); // itemsの全商品、カテゴリーを取得
        $itemsWithTax = $items->map(function ($item) {
            $item->subtotal = $item->tax_sales_prices; // 税込み価格
            $item->regtotal = $item->tax_regular_prices; // 税込み価格
            // is_active が 0 の場合は '販売停止中'
            if ($item->is_active === 0) {
                $item->state = '販売停止中';
            } else {
                $item->state = '販売中';
            }
            return $item;
        });

        return view('admin.items.index', compact('items', 'itemsWithTax'));
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
    public function create(Request $request)
    {

        // カテゴリーを取得
        $categories = Category::all();
        return view('admin.items.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * 入力値送信
     *
     * @param Request $request
     * @return void
     */
    public function post(Request $request)
    {
        $input = $request->except(['files']);
        $validator = Validator::make($input, $this->validator);
        if ($validator->fails()) {
            return redirect()->route("admin.items.create")
                ->withInput()
                ->withErrors($validator);
        }
        $filePaths = [];
        if ($request->hasFile('files')) {
            $imageFiles = $request->file('files');
            foreach ($imageFiles as $image) {
                $imgName = date('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imgName);
                $filePaths[] = $imgName;
            }
        }
        // ファイルパスだけをセッションに保存
        $input['file_paths'] = $filePaths;
        // セッションに保存
        $request->session()->put("form_input", $input);
        // 確認画面にリダイレクト
        return redirect()->route("admin.items.confirm");;
    }

    /**
     * 確認画面
     *
     * @param Request $request
     * @return void
     */
    function confirm(Request $request)
    {
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");
        // カテゴリーを取得
        $categories = Category::all();
        //セッションに値が無い時はフォームに戻る
        if (!$input) {
            return redirect()->route("admin.items.create");
        }

        return view("admin.items.confirm", [
            "input" => $input,
            "categories" => $categories,
        ]);
    }

    /**
     * 商品情報・画像をテーブルに追加
     **/
    public function store(Request $request)
    {
        // セッションから値を取り出す
        $input = $request->session()->get("form_input");
        //戻るボタンが押された時
        if ($request->input('action') === 'back') {
            return redirect()->route("admin.items.create")
                ->withInput($input);
        }
        // 不正なアクセス
        if (!$input) {
            return redirect()->route("admin.items.create");
        }
        // items テーブルにアイテムを作成
        $item = Item::create($input);
        // 画像のファイルパスを使用して画像レコードを作成
        if (isset($input['file_paths'])) {
            foreach ($input['file_paths'] as $filePath) {
                $image = Image::create(['img_path' => $filePath]);
                $item->images()->attach($image->id);
            }
        }
        // サムネイルの設定
        if (isset($input['thumbnail'])) {
            $item->thumbnail = $input['thumbnail'];
            $item->save();
        }
        // セッションをクリア
        $request->session()->forget("form_input");
        return redirect()->route('admin.items.index');
    }

    /**
     * 商品編集画面を表示（管理者）
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('admin.items.edit', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * 商品内容更新処理
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // 商品情報を取得
        $item = Item::findOrFail($id);
        $validator = Validator::make($request->all(), $this->validator);
        if ($validator->fails()) {
            return redirect()->route('admin.items.edit', ['item' => $id])
                ->withInput()
                ->withErrors($validator);
        }
        // 商品情報の更新
        $item->update($request->except(['files']));
        // 画像の処理
        if ($request->hasFile('files')) {
            // 新しい画像を保存
            $filePaths = [];
            foreach ($request->file('files') as $image) {
                $imgName = date('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imgName);
                $filePaths[] = $imgName;
            }
            // 新しい画像レコードを作成し、関連付ける
            foreach ($filePaths as $filePath) {
                $image = Image::create(['img_path' => $filePath]);
                $item->images()->attach($image->id);
            }
        }
        // サムネイルの更新
        if ($request->has('thumbnail')) {
            $item->thumbnail = $request->input('thumbnail');
            $item->save();
        }
        // 販売停止または販売開始の処理
        if ($request->input('action') === 'stop') {
            $item->is_active = false;
            $item->save();
            return redirect()->route('admin.items.index')->with('attention', '商品が販売停止にされました。');
        } elseif ($request->input('action') === 'start') {
            $item->is_active = true;
            $item->save();
            return redirect()->route('admin.items.index')->with('attention', '商品が販売開始されました。');
        }
        $request->session()->flash('attention', '商品が更新されました。');
        // リダイレクト
        return redirect()->route('admin.items.index');
    }

    /**
     * カートの商品削除
     *
     * @param Request $request
     * @return void
     */
    public function destroy($id)
    {
        // 商品情報を取得
        $item = Item::findOrFail($id);
        $item->images()->delete(); // 画像関連を削除
        foreach ($item->images as $image) {
            Storage::delete('public/images/' . $image->img_path);
        }
        // 商品を削除
        $item->delete();
        // リダイレクト
        return redirect()->route('admin.items.index')->with('attention', '商品が削除されました。');
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
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('category_name', 'LIKE', "%{$query}%");
            })
            ->paginate(10);
        $itemsWithTax = $items->map(function ($item) {
            $item->subtotal = $item->tax_sales_prices;
            $item->regtotal = $item->tax_regular_prices;
            $item->state = $item->is_active === 0 ? '販売停止中' : '販売中';
            return $item;
        });

        return view('admin.items.index', compact('items', 'itemsWithTax', 'query'));
    }
}
