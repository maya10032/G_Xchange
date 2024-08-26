<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ItemController::class, 'index']);
Route::get('/items', [ItemController::class, 'create']);
Route::post('/items', [ItemController::class, 'store']);
Route::delete('/items/{item}', [ItemController::class, 'destroy']);
Route::get('/items/{item}/edit', [ItemController::class, 'edit']);
Route::put('/items/{item}', [ItemController::class, 'update']);
Route::get('/items/{item}/show', [ItemController::class, 'show']);
