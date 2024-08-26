<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Auth::routes();

// 管理者用ログインルート
Route::prefix('admin')->name('admin.')->group(function () {
    // ログイン・ログアウト
    Route::get('login', [App\Http\Controllers\AdminAuth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\AdminAuth\LoginController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AdminAuth\LoginController::class, 'logout'])->name('logout');

    // パスワードリセット
    Route::get('password/reset', [App\Http\Controllers\AdminAuth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [App\Http\Controllers\AdminAuth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [App\Http\Controllers\AdminAuth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [App\Http\Controllers\AdminAuth\ResetPasswordController::class, 'reset'])->name('password.update');

    // ダッシュボード
    Route::get('dashboard', [App\Http\Controllers\AdminAuth\DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
