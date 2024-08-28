<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;

Auth::routes();

// ユーザ 商品一覧
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
// 商品
Route::resource('items', App\Http\Controllers\ItemController::class);

Route::get('/items/show/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
// 購入内容確認画面表示
Route::get('/items/purchase/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('purchase.show');
// ユーザログイン後のみアクセス可
Route::middleware('auth')->group(function () {
    // ？？？
    Route::resource('items', App\Http\Controllers\ItemController::class);
    // お気に入り
    Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes.index');
    Route::post('/likes', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy');
});

// 管理ログイン画面
Route::get('/admin-login', [AdminLoginController::class, 'create'])->name('admin.login');
Route::post('/admin-login', [AdminLoginController::class, 'store'])->name('admin.login.store'); // 管理ログイン
Route::delete('/admin-login', [AdminLoginController::class, 'destroy'])->name('admin.login.destroy');
// 管理ログイン後のみアクセス可
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin.items.index', function () {
        return view('admin.items.index');
    })->name('admin.items.index');
});

// 管理者側（商品一覧）
Route::get('/admin/items', [App\Http\Controllers\Admin\ItemController::class, 'index'])->name('admin.items.index');
Route::get('/admin/items/{item}/show', [App\Http\Controllers\Admin\ItemController::class, 'show']); // 商品詳細
Route::get('/admin/items/{item}/cere', [App\Http\Controllers\Admin\ItemController::class, 'edit']); // 商品編集


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
