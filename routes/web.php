<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SiteController::class, 'index'])
    ->name('index');

Route::middleware('auth')
    ->group(
        function () {
            Route::resource('products', ProductController::class)
                ->except('index', 'show');
        }
    );

Route::resource('products', ProductController::class)
    ->only('index', 'show');
