<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return view('items/index');});
Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);

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

// ユーザ 商品一覧
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);

// 管理者側（商品一覧）
Route::get('/admin/items', [App\Http\Controllers\Admin\ItemController::class, 'index'])->name('admin.items.index');
Route::get('/admin/items/{item}/show', [App\Http\Controllers\Admin\ItemController::class, 'show']); // 商品詳細

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
