<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;

class UserController extends Controller
{
    use Sortable;

    protected $sortable = ['id', 'name', 'phone', 'address', 'email'];

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
