<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $items = \Auth::user()->likeItems()->orderBy('created_at', 'desc')->paginate(10);
        return view('likes.index', ['items' => $items]);
    }

    public function store(Request $request)
    {
        \Auth::user()->likeItems()->attach($request->item_id);
        $request->session()->flash('likeadd', 'お気に入りに追加しました');
        return back();
    }

    public function destroy(Request $request)
    {
        \Auth::user()->likeItems()->detach($request->item_id);
        $request->session()->flash('likedelete', 'お気に入りを削除しました');
        return back();
    }
}
