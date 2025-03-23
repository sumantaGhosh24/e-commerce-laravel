<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/add-cart', [CartController::class, 'add'])->name('cart.add');

    Route::post('/remove-cart', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/clear-cart', [CartController::class, 'clear'])->name('cart.clear');

    Route::post('/coupon-verify', [CartController::class, 'verify'])->name('cart.coupon');
});