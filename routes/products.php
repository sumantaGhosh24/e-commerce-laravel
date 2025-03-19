<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProductController::class, 'home'])->name('dashboard');

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    Route::get('/product', [ProductController::class, 'create'])->name('product.create');

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');

    Route::get('/product/{id}', [ProductController::class, 'edit'])->name('product.edit');

    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::put('/addimage/{id}', [ProductController::class, 'add'])->name('product.image.add');

    Route::put('/removeimage/{id}/{imageId}', [ProductController::class, 'remove'])->name('product.image.remove');

    Route::put('/addattribute/{id}', [ProductController::class, 'addAttribute'])->name('product.attribute.add');

    Route::put('/removeattribute/{id}/{attributeId}', [ProductController::class, 'removeAttribute'])->name('product.attribute.remove');

    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});