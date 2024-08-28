<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
{
  $items = \Auth::user()->likeItems()->orderBy('created_at', 'desc')->get();
  return view('likes.index', ['items' => $items]);
}

public function store(Request $request)
{// 多対多専用の「attach」ヘルパーでレコードに追加
  \Auth::user()->likeItems()->attach($request->item_id);
  return back();
}

public function destroy(Request $request)
{// 「detach」ではマッチする対象レコードを削除
  \Auth::user()->likeItems()->detach($request->item_id);
  return back();
}
}
