<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

require __DIR__ . '/auth.php';
require __DIR__ . '/auth-admin.php';
require __DIR__ . '/categories.php';
require __DIR__ . '/banners.php';
require __DIR__ . '/products.php';
require __DIR__ . '/contacts.php';
require __DIR__ . '/coupons.php';
require __DIR__ . '/reviews.php';
