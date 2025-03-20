<?php

use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons');

    Route::get('/coupon', [CouponController::class, 'create'])->name('coupon.create');

    Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');

    Route::get('/coupon/{id}', [CouponController::class, 'edit'])->name('coupon.edit');

    Route::put('/coupon/{id}', [CouponController::class, 'update'])->name('coupon.update');

    Route::delete('/coupon/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
});