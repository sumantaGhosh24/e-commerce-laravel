<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/banners', [BannerController::class, 'index'])->name('banners');

    Route::get('/banner', [BannerController::class, 'create'])->name('banner.create');

    Route::post('/banner', [BannerController::class, 'store'])->name('banner.store');

    Route::get('/banner/{id}', [BannerController::class, 'edit'])->name('banner.edit');

    Route::put('/banner/{id}', [BannerController::class, 'update'])->name('banner.update');

    Route::put('/banner/image/{id}', [BannerController::class, 'image'])->name('banner.image');

    Route::delete('/banner/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
});