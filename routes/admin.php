<?php

use App\Http\Controllers\Admin\ItemController;

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('items', [ItemController::class, 'index'])->name('items.index');
    Route::get('items/{item}/show', [ItemController::class, 'show'])->name('items.show'); // 管理者用商品詳細
    Route::get('items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit'); // 管理者用商品編集
});
