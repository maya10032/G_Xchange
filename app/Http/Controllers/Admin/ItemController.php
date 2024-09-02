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
    protected $taxRate = 0.1; // プロパティとして税率を定義

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
    public function create(Request $request)
    {
        // セッションから入力データを取得
        $item_data = $request->session()->get('item_data', []);
        // カテゴリーを取得
        // $categories = Category::all();
        // ビューにデータを渡す
        return view('admin.items.create', [
            'item_data'  => $item_data,
            // 'categories' => $categories,
        ]);
    }


    /**
     * 確認画面へ移動
     **/
    function post(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            // 'item_code'     => 'required|string|max:255',
            // 'item_name'     => 'required|string|max:255',
            // 'category_id'   => 'required',
            // 'count_limit'   => 'required|integer',
            // 'sales_price'   => 'required|integer',
            // 'regular_price' => 'integer',
            // 'message'       => 'required|nullable|string',
            'images'        => 'required|array|min:1|max:4',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail'     => 'required|integer|between:0,3',
        ]);

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
        $request->session()->put('item_data', $sessionData);

        // $categories = Category::all();
        // $request->session()->put('categories', $categories);

        return redirect()->action([ItemController::class, 'confirm']);
    }

    /**
     * 新規登録確認画面
     *
     * @param Request $request
     * @return void
     */
    public function confirm(Request $request)
    {
        // セッションから値を取り出す
        $filePaths  = $request->session()->get('file_paths', []);
        $input      = $request->session()->get('item_data', []);
        if (!$input) {
            return redirect()->route('admin.items.create')->with('error', '無効なアクセスです');
        }

        $filePaths = $input['file_paths'] ?? [];
        // $categories = Category::all();

        // 税込み価格の計算
        // $regularPriceWithTax = $input['regular_price'] * (1 + $this->taxRate);
        // $salesPriceWithTax = $input['sales_price'] * (1 + $this->taxRate);

        // セッションに値が無ければフォームに戻す
        return view('admin.items.confirm', [
            'filePaths'  => $filePaths,
            'item_data'  => $input,
            // 'categories' => $categories,
            // 'regularPriceWithTax' => $regularPriceWithTax,
            // 'salesPriceWithTax' => $salesPriceWithTax,
        ]);
    }

    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        // 戻るボタン押下でフォームに戻る
        if ($request->input('back') == 'back') {
            $request->session()->put('file_paths', $request->input('file_paths', []));
            return redirect()->route('admin.items.create')
                ->withInput($request->except('file_paths'));
        }
        // セッションからデータを取得
        $input = $request->session()->get('item_data');
        if (!$input) {
            return redirect()->route('admin.items.create')->with('error', '無効なアクセスです。');
        }
        // 商品の登録
        // $item = Item::create([
        //     'category_id'   => $input['category_id'],
        //     'item_name'     => $input['item_name'],
        //     'item_code'     => $input['item_code'],
        //     'count_limit'   => $input['count_limit'],
        //     'sales_price'   => $input['sales_price'],
        //     'regular_price' => $input['regular_price'],
        //     'message'       => $input['message'],
        //     'is_active'     => $request->input('is_active', 1),
        // ]);

        $filePaths = $request->input('file_paths', []);
        if (empty($filePaths)) {
            return redirect()->back()->with('error', '画像が選択されていません。');
        }

        $imageIds = [];
        foreach ($filePaths as $filePath) {
            // 画像パスから画像レコードを作成
            $imageRecord = Image::create([
                'img_path' => $filePath,
            ]);
            $imageIds[] = $imageRecord->id;
        }

        // `item_images` テーブルに商品と画像の関連付けを保存
        foreach ($imageIds as $imageId) {
            ItemImage::create([
                // 'item_id'   => $item->id,
                'image_id'  => $imageId,
            ]);
        }

        // セッションデータのクリア
        $request->session()->forget('item_data');
        return redirect()->route('admin.items.index')->with('attention', '商品が作成されました。');
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
