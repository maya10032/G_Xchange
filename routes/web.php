<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', [ItemController::class, 'index']);
// Route::get('/items', [ItemController::class, 'create']);
// Route::post('/items', [ItemController::class, 'store']);
// Route::delete('/items/{item}', [ItemController::class, 'destroy']);
// Route::get('/items/{item}/edit', [ItemController::class, 'edit']);
// Route::put('/items/{item}', [ItemController::class, 'update']);
// Route::get('/items/{item}/show', [ItemController::class, 'show']);

Route::resource('items', App\Http\Controllers\ItemController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
