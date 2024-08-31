<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $user = $request->user();
        // 現在のパスワードと一致するか確認
        if (!Hash::check($request->password, $user->password)) {
            // return redirect()->back()->with('say', '現在のパスワードが間違っています。');
            $request->session()->flash('ConfirmPassword', 'パスワードが違います');
            return back();
            return redirect()->back()->with('say', '現在のパスワードが間違っています。');
        }

        if ($request->user()->isDirty('name')) {
            $request->user()->name_verified_at = null;
        } elseif ($request->user()->isDirty('phone')) {
            $request->user()->phone_verified_at = null;
        } elseif ($request->user()->isDirty('address')) {
            $request->user()->address_verified_at = null;
        } elseif ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        $request->session()->flash('update', '保存しました');
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
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

        return Redirect::to('/');
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
