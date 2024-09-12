<?php
// 管理者用ユーザコントローラー
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * ユーザ一覧を表示
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        $users = User::orderBy($sort, $direction)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * ユーザ詳細画面を表示
     */
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'DESC');

        $orders = Order::select('orders.*', 'items.item_name', 'items.sales_price')
            ->join('items', 'orders.item_id', '=', 'items.id')
            ->where('orders.user_id', $user->id)
            ->orderBy($sort, $direction)
            ->paginate(10);

        // 小計合計の計算
        $ordersWithTax = $orders->map(function ($order) {
            $order->subtotal = $order->item->tax_sales_prices * $order->count;
            return $order;
        });

        return view('admin.users.show', compact('user', 'orders'));
    }

    /**
     * ユーザ変更画面
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * ユーザ更新処理
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name'     => 'required|string|max:50',
            'phone'    => 'required|digits:11|unique:users,phone,' . $id,
            'address'  => 'required|string|max:200',
            'email'    => 'required|string|email|max:50|unique:users,email,' . $id,
        ];
        // バリデーション実行
        $validated = $request->validate($rules);
        $isUpdated = false;
        foreach ($validated as $key => $value) {
            if ($user->$key !== $value) {
                $user->$key = $value;
                $isUpdated = true;
            }
        }
        // ユーザ情報を更新
        if ($isUpdated) {
            $user->save();
            // 更新完了メッセージ
            $request->session()->flash('userupdate', 'ユーザ情報を更新しました');
        } else {
            // 更新がない場合のメッセージ
            $request->session()->flash('userupdate', '変更はありませんでした');
        }
        // ユーザ一覧へリダイレクト
        return Redirect::route('admin.users.index');
    }

    /**
     * ユーザ削除画面を表示（管理者）
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::route('admin.users.index')->with('userdelete', 'ユーザ情報を削除しました');
    }

    /**
     * 検索機能
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->paginate(10);

        return view('admin.users.index', compact('users', 'query'));
    }
}
