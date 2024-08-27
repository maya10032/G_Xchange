<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        $collection = Item::all();
        return view('items', ['items' => $collection]);
    }

    /**
     * 商品詳細ページ表示
     *
     * @return void
     */
    // public function show()
    // {
    //     $item = Item::where('user_id', Auth::user()->id)->find($item_id);
    //     return view('show', ['item' => $item]);
    // }

    /**
     * 新規追加フォーム表示
     *
     * @return void
     */
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_code'     => 'required',
            'item_name'     => 'required | max:50',
            'category_id'   => 'required',
            'count_limit'   => 'required | numeric',
            'sales_price'   => 'required | numeric',
            'regular_price' => 'required | numeric',
            'message'       => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/items')->withInput()->withErrors($validator);
        }

        $item = new Item;
        $item->item_code     = $request->item_code;
        $item->item_name     = $request->item_name;
        $item->category_id   = $request->category_id;
        $item->count_limit   = $request->count_limit;
        $item->sales_price   = $request->sales_price;
        $item->regular_price = $request->regular_price;
        $item->message       = $request->message;
        $item->save();
        $request->session()->flash('success', '商品を登録しました');

        $request->user()->items()->create($request->all()); // 既存

        if ($request->validate->fails()) {
            return redirect(route('items.show'))->withInput()->withErrors($request->validate);
        }

        if ($image = $request->file('image')) {
            $upPath = 'images/';
            $imgName = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($upPath, $imgName);
            $input['image'] = "$imgName";
        }

        return redirect(route('items.index')); // 既存

        return redirect('/');
    }

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
