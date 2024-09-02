<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $collection = User::all();
        return view('users.index', ['users' => $collection]);
    }

    public function destroy(Request $request)
    {
        $user = \Auth::user(); // 現在のログインユーザーを取得
        $user->delete(); // ユーザーを削除
        $request->session()->flash('withdrawal', '退会');
        return redirect()->route('items.index');
    }
}
