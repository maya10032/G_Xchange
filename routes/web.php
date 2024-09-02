<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Auth::routes();

// ユーザ・会員
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
Route::resource('items', App\Http\Controllers\ItemController::class);
// Route::get('/show/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
Route::get('items/{item}/show', [ItemController::class, 'show'])->name('items.show'); // 一般ユーザー用商品詳細
// Route::get('/items/show/{item}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
const CONTACT_PATH = App\Http\Controllers\ContactsController::class;
// お問い合わせページ
Route::get('/contact',          [CONTACT_PATH, 'show'])->name('contact.show');
Route::post('/contact',         [CONTACT_PATH, 'post'])->name('contact.post');
Route::get('/contact/confirm',  [CONTACT_PATH, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm', [CONTACT_PATH, 'send'])->name('contact.send');
Route::get('/contact/done',     [CONTACT_PATH, 'done'])->name('contact.done');

// ユーザログイン後のみアクセス可
Route::middleware('auth')->group(function () {
    // 購入内容確認画面表示
    Route::get('/purchase/{item}',  [App\Http\Controllers\ItemController::class, 'purchase'])->name('items.purchase');
    // 購入確認画面へのPOSTリクエストで数量引き継ぎ
    Route::post('/purchase/{item}', [App\Http\Controllers\ItemController::class, 'purchaseConfirm'])->name('items.purchaseConfirm');
    // 注文
    Route::post('/orders',         [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/complete', [App\Http\Controllers\OrderController::class, 'complete'])->name('orders.complete');
    // お気に入り
    Route::get('/likes',    [App\Http\Controllers\LikeController::class, 'index'])->name('likes.index'); // 表示
    Route::post('/likes',   [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store'); // 追加
    Route::delete('/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy'); // 削除
    // カートに追加
    Route::post('/purchase/{item}', [App\Http\Controllers\CartController::class, 'store'])->name('purchase.store');
    // カート一覧表示
    Route::get('/carts', [App\Http\Controllers\CartController::class, 'index'])->name('carts.index');
    // まとめて購入
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    // カートの商品削除
    Route::delete('/carts/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('carts.destroy');
    // 購入履歴表示（マイページ）
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    // 会員情報変更表示
    Route::get('/profile',    [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    // 退会
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index'); // 退会画面表示
    Route::delete('/users', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy'); // ユーザ削除
});

// 管理ログイン・新規登録
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',     [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login',    [LoginController::class, 'login']);
    Route::post('logout',   [LoginController::class, 'logout'])->name('logout');
    Route::get('register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

const ADMIN_ITEM_PATH = App\Http\Controllers\Admin\ItemController::class;

// 管理者ログイン後のみアクセス可
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // 管理者側（商品一覧）
    Route::get('items',             [ADMIN_ITEM_PATH, 'index'])->name('items.index');
    Route::post('items',            [ADMIN_ITEM_PATH, 'store'])->name('items.store');
    Route::get('items/create',      [ADMIN_ITEM_PATH, 'create'])->name('items.create');
    Route::post('items/create',     [ADMIN_ITEM_PATH, 'post'])->name('items.post');
    Route::get('items/confirm',     [ADMIN_ITEM_PATH, 'confirm'])->name('items.confirm');
    Route::post('items/confirm',    [ADMIN_ITEM_PATH, 'store'])->name('items.store');
    Route::get('items/{item}/show', [ADMIN_ITEM_PATH, 'show'])->name('items.show');
    Route::get('items/{item}/edit', [ADMIN_ITEM_PATH, 'edit'])->name('items.edit');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
