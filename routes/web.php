<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// route home utama
Route::get('/', \App\Livewire\Home::class)->name('home');

// untuk login
Route::middleware('guest')->group(function () {
    // SignIn / SignUp UI
    Route::prefix('auth')->group(function () {
        Route::get('/sing-in', \App\Livewire\Auth\SignIn::class)->name('login');
        Route::get('/sign-up', \App\Livewire\Auth\SignUp::class)->name('register');
    });
    
});
// khusus sudah login
Route::middleware('auth')->group(function () {
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/profile', \App\Livewire\Account\Profile::class)->name('profile');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', \App\Livewire\Dashboard\Dashboard::class)->name('index');
        Route::get('/products', \App\Livewire\Dashboard\Products\Index::class)->name('products.index');
        Route::get('/categories', \App\Livewire\Dashboard\Categories\Index::class)->name('categories.index');
    });

    // cart
    Route::get('/cart', \App\Livewire\Cart\Cart::class)->name('cart');
    Route::get('/order/{codeOrder}', \App\Livewire\Order\Order::class)->name('order');
});

// route product
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', \App\Livewire\Products\Products::class)->name('index');
    Route::get('/show/{slug}', \App\Livewire\Products\Show::class)->middleware('auth')->name('show');
});
Route::get('/categories', \App\Livewire\Products\Products::class)->name('categories');

