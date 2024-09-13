<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

// ユーザ・会員
// Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
Route::resource('items', App\Http\Controllers\ItemController::class);
// Route::get('items/{item}/show', [ItemController::class, 'show'])->name('items.show'); // 一般ユーザー用商品詳細
Route::get('/search',     [ItemController::class, 'search'])->name('items.search');
// お問い合わせページ
Route::get('/contact',          [App\Http\Controllers\ContactsController::class, 'show'])->name('contact.show');
Route::post('/contact',         [App\Http\Controllers\ContactsController::class, 'post'])->name('contact.post');
Route::get('/contact/confirm',  [App\Http\Controllers\ContactsController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm', [App\Http\Controllers\ContactsController::class, 'send'])->name('contact.send');
Route::get('/contact/done',     [App\Http\Controllers\ContactsController::class, 'done'])->name('contact.done');
//フッター
Route::get('/company/companyprofile', [App\Http\Controllers\CompanyController::class, 'profile'])->name('company.profile');
Route::get('/company/recruit', [App\Http\Controllers\CompanyController::class, 'recruit'])->name('company.recruit');
Route::get('/company/service', [App\Http\Controllers\CompanyController::class, 'service'])->name('company.service');
Route::get('/company/privacy', [App\Http\Controllers\CompanyController::class, 'privacy'])->name('company.privacy');
Route::get('/company/transaction', [App\Http\Controllers\CompanyController::class, 'transaction'])->name('company.transaction');
Route::get('/company/funding', [App\Http\Controllers\CompanyController::class, 'funding'])->name('company.funding');
Route::get('/company/law', [App\Http\Controllers\CompanyController::class, 'law'])->name('company.law');

// ユーザログイン後のみアクセス可
Route::middleware('auth')->group(function () {
    // 購入内容確認画面表示
    Route::get('/purchase/{item}',  [App\Http\Controllers\ItemController::class, 'purchase'])->name('items.purchase');
    // 購入確認画面へのPOSTリクエストで数量引き継ぎ
    Route::post('/purchase/{item}', [App\Http\Controllers\ItemController::class, 'purchaseConfirm'])->name('items.purchaseConfirm');
    // 注文
    // Route::post('/orders/create',   [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders',         [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/complete', [App\Http\Controllers\OrderController::class, 'complete'])->name('orders.complete');
    // お気に入り
    Route::get('/likes',    [App\Http\Controllers\LikeController::class, 'index'])->name('likes.index'); // 表示
    Route::post('/likes',   [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store'); // 追加
    Route::delete('/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy'); // 削除
    // カートに追加
    Route::post('/purchase/{item}', [App\Http\Controllers\CartController::class, 'store'])->name('purchase.store');
    Route::get('/carts',            [App\Http\Controllers\CartController::class, 'index'])->name('carts.index');
    Route::post('/orders',          [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::delete('/carts/{id}',    [App\Http\Controllers\CartController::class, 'destroy'])->name('carts.destroy');
    // 購入履歴表示（マイページ）
    Route::get('/orders',           [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/show', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    // 会員情報変更表示
    Route::get('/profile',    [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    // 退会
    Route::get('/users',    [App\Http\Controllers\UserController::class, 'index'])->name('users.index'); // 退会画面表示
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

// 管理者ログイン画面
Route::get('/admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
// 管理者ログイン後のみアクセス可
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // 管理者側（商品一覧）
    Route::get('items',             [App\Http\Controllers\Admin\ItemController::class, 'index'])->name('items.index');
    Route::post('items',            [App\Http\Controllers\Admin\ItemController::class, 'store'])->name('items.store');
    Route::get('items/create',      [App\Http\Controllers\Admin\ItemController::class, 'create'])->name('items.create');
    Route::post('items/create',     [App\Http\Controllers\Admin\ItemController::class, 'post'])->name('items.post');
    Route::get('items/confirm',     [App\Http\Controllers\Admin\ItemController::class, 'confirm'])->name('items.confirm');
    Route::post('items/store',      [App\Http\Controllers\Admin\ItemController::class, 'store'])->name('items.store');
    Route::get('items/{item}/show', [App\Http\Controllers\Admin\ItemController::class, 'show'])->name('items.show');
    Route::get('items/{item}/edit', [App\Http\Controllers\Admin\ItemController::class, 'edit'])->name('items.edit');
    Route::put('items/{id}',        [App\Http\Controllers\Admin\ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}',  [App\Http\Controllers\Admin\ItemController::class, 'destroy'])->name('items.destroy');
    Route::get('/items/search',     [App\Http\Controllers\Admin\ItemController::class, 'search'])->name('items.search');
    // カテゴリー
    Route::get('/categories',          [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories',          [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories',          [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create',   [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories',         [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{id}',      [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}',   [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/search',   [App\Http\Controllers\Admin\CategoryController::class, 'search'])->name('categories.search');

    // 受注管理表示
    Route::get('/orders',           [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/show', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/search',    [App\Http\Controllers\Admin\OrderController::class, 'search'])->name('orders.search');
    // ユーザ管理表示
    Route::get('/users',             [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/show',   [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit',   [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}',     [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/search',      [App\Http\Controllers\Admin\UserController::class, 'search'])->name('users.search');
    // 会員情報変更表示
    Route::get('/profile',        [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/show',   [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/show', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',     [App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('profile.destroy');
});
