<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('items/index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Auth::routes();

// 管理ログイン画面
Route::get('/admin-login', [AdminLoginController::class, 'create'])->name('admin.login');
// 管理ログイン
Route::post('/admin-login', [AdminLoginController::class, 'store'])->name('admin.login.store');
// 管理ログアウト
Route::delete('/admin-login', [AdminLoginController::class, 'destroy'])->name('admin.login.destroy');
// 管理ログイン後のみアクセス可
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin.top');
    })->name('admin.top');
});

// ユーザ 商品一覧
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
// ユーザ 商品詳細
Route::get('/show/{id?}', [App\Http\Controllers\ItemController::class, 'show']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
