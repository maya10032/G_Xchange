<?php
// 管理者用ユーザコントローラー
namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * ユーザ一覧を表示（管理者）
     */
    public function index()
    {
        $users = User::all(); // 全ユーザを取得
        return view('admin.users.index', compact('users'));
    }

    /**
     * ユーザ詳細（変更）画面を表示（管理者）
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * ユーザ詳細（削除）画面を表示（管理者）
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * ユーザ更新画面を表示（管理者）
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        // $user = $request->user();

        // if ($request->user()->isDirty('name')) {
        //     $request->user()->name_verified_at = null;
        // } elseif ($request->user()->isDirty('phone')) {
        //     $request->user()->phone_verified_at = null;
        // } elseif ($request->user()->isDirty('address')) {
        //     $request->user()->address_verified_at = null;
        // } elseif ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        $request->user()->save();
        $request->session()->flash('userupdate', 'ユーザ情報を更新しました');
        return Redirect::route('admin.users.index')->with('status', 'profile-updated');
    }

    /**
     * ユーザ削除画面を表示（管理者）
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $action = $request->input('action');

        if ($action === 'update') {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));

        } elseif ($action === 'destroy') {
            $user = $request->user();

            // Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $request->session()->flash('userdelete', 'ユーザ情報を削除しました');
            return Redirect::to('admin.users.index');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:50'],
            'phone'    => ['required', 'integer', 'min:11'],
            'address'  => ['required', 'string', 'max:200'],
            'email'    => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
