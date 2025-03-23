<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');

    Route::get('/order-success', [OrderController::class, 'store'])->name('order.store');

    Route::get('/orders', [OrderController::class, 'myOrders'])->name('orders');

    Route::get('/order/{id}', [OrderController::class, 'myOrder'])->name('order');

    Route::get('/order-email/{id}', [OrderController::class, 'sendEmail'])->name('order.email');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    Route::get('/order/{id}', [OrderController::class, 'edit'])->name('order.edit');

    Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
});