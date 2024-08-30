<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Auth::routes();

// ユーザ・会員
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
Route::resource('items', App\Http\Controllers\ItemController::class);
Route::get('/show/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
// Route::get('/items/show/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
// お問い合わせページ
Route::get('/contact',         [App\Http\Controllers\ContactsController::class, 'show'])->name('contact.show');
Route::post('/contact',         [App\Http\Controllers\ContactsController::class, 'post'])->name('contact.post');
Route::get('/contact/confirm', [App\Http\Controllers\ContactsController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm', [App\Http\Controllers\ContactsController::class, 'send'])->name('contact.send');
Route::get('/contact/done',    [App\Http\Controllers\ContactsController::class, 'done'])->name('contact.done');

// ユーザログイン後のみアクセス可
Route::middleware('auth')->group(function () {
    // 購入内容確認画面表示
    Route::get('/purchase/{item}', [App\Http\Controllers\ItemController::class, 'purchase'])->name('items.purchase');
    // 購入確認画面へのPOSTリクエストで数量引き継ぎ
    Route::post('/purchase/{item}', [App\Http\Controllers\ItemController::class, 'purchaseConfirm'])->name('items.purchaseConfirm');
    // 注文
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/complete', [App\Http\Controllers\OrderController::class, 'complete'])->name('orders.complete');
    // お気に入り
    Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes.index'); // 表示
    Route::post('/likes', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store'); // 追加
    Route::delete('/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy'); // 削除
    // カートに追加
    Route::post('/purchase/{item}', [App\Http\Controllers\CartController::class, 'handleAction'])->name('purchase.handle');
    // カート一覧表示
    Route::get('/carts', [App\Http\Controllers\CartController::class, 'index'])->name('carts.index');
    // カートの商品削除
    Route::delete('/carts/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('carts.destroy');
    // 購入履歴表示（マイページ）
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
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


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
