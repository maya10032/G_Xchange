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

Route::get('/home',  [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\ItemController::class, 'index'])->name('items.item');
