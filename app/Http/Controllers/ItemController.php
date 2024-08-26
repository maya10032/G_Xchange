<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * 一覧ページ作成
     *
     * @return void
     */
    public function index()
    {
        $collection = Item::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('items', ['items' => $collection]);
    }

    /**
     * 商品詳細ページ表示
     *
     * @return void
     */
    public function show()
    {

    }

    /**
     * 新規追加フォーム表示
     *
     * @return void
     */
    public function create()
    {
        return view('create');
    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
