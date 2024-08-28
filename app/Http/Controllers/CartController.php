<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = \Auth::user()->cartItems()->orderBy('created_at', 'desc')->get();
        return view('carts.index', ['items' => $items]);
    }

    public function store(Request $request)
    {
        \Auth::user()->cartItems()->attach($request->item_id);
        return back();
    }

    public function destroy(Request $request)
    {
        \Auth::user()->cartItems()->detach($request->item_id);
        return back();
    }
}
