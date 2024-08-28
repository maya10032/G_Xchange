<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 一覧ページ作成
     *
     * @return void
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * 購入ボタン押下後、ordersテーブルにデータ追加
     *
     * @param Request $request
     * @return void
     */
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
}
