<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/my-reviews', [ReviewController::class, 'myReviews'])->name('reviews');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
});