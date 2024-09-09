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
            $item->subtotal = $item->sales_price * (1 + $this->taxRate); // 税込み価格
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
        return view('admin.items.cere', ['item' => $item]);
    }
}
