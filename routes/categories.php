<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::put('/category/image/{id}', [CategoryController::class, 'image'])->name('category.image');

    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});