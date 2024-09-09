<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

    class ProfileController extends Controller
{
    /**
     * Display the asmin's profile form.
     */
    public function show(Request $request): View
    {
        return view('admin.profile.show', [
            'admin' => Auth::guard('admin')->user(),
        ]);
    }

    /**
     * Display the asmin's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'admin' => Auth::guard('admin')->user(),
        ]);
    }

    /**
     * Update the admin's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user(); // adminsテーブルのユーザーを取得
        $admin->fill($request->validated());
        // 現在のパスワードと一致するか確認
        if (!Hash::check($request->password, $admin->password)) {
            $request->session()->flash('ConfirmPassword', 'パスワードが違います');
            return back();
            return redirect()->back()->with('say', '現在のパスワードが間違っています。');
        }

        // if ($admin->isDirty('name')) {
        //     $admin->name_verified_at = null;
        // } elseif ($admin->isDirty('email')) {
        //     $admin->email_verified_at = null;
        // }

        $admin->save();
        $request->session()->flash('update', '保存しました');
        return Redirect::route('admin.profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the admin's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('admin.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:50'],
            'email'    => ['required', 'string', 'email', 'max:50', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
