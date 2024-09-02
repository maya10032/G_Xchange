<?php
// 管理者用ユーザコントローラー
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends Controller
{
    /**
     * 商品一覧を表示（管理者）
     */
    public function index()
    {
        $users = User::all(); // 全商品を取得
        return view('admin.users.index', compact('users'));
    }

    /**
     * 商品詳細画面を表示（管理者）
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * 商品編集画面を表示（管理者）
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.cere', ['user' => $user]);
    }
}
