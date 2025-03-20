<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
});