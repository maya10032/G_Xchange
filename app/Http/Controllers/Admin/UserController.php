<?php
// 管理者用ユーザコントローラー
namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Order;
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
    public function edit(User $user)
    {
        // $user = User::findOrFail($id);
        // $user = User::with(['orders', 'item'])->findOrFail($id);
        // return view('admin.users.edit', compact('user'));
        //odersテーブルのデータ取得、新しい順で表示
        $orders = Order::where('user_id', $user->id)
            ->with('item', 'category')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            dd($orders);

        // 小計合計の計算
        // $ordersWithTax = $orders->map(function ($order) {
            // 小計（税込み）を計算（Itemモデルで計算引き継ぎ）
            // $order->subtotal = $order->item->tax_sales_prices * $order->count;
            // return $order;
        // });

        return view('admin.users.edit', compact('orders', 'user'));
    }

    /**
     * ユーザ更新画面を表示（管理者）
     */
    public function update(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        // 指定されたIDのユーザを取得
        $user = User::findOrFail($id);
        // リクエストからのデータをユーザに反映
        $user->fill($request->validated());
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

        $user->save();
        $request->session()->flash('userupdate', 'ユーザ情報を更新しました');
        return Redirect::route('admin.users.index')->with('status', 'profile-updated');
    }

    /**
     * ユーザ削除画面を表示（管理者）
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        $request->session()->flash('userdelete', 'ユーザ情報を削除しました');
        return Redirect::route('admin.users.index')->with('status', 'profile-updated');
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
