<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// SignIn / SignUp UI
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/sing-in', \App\Livewire\Auth\SignIn::class)->name('signIn');
    Route::get('/sing-up', \App\Livewire\Auth\SignUp::class)->name('signUp');
});

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::get('/categories', \App\Livewire\Products\Products::class)->name('categories');
Route::get('/cart', \App\Livewire\Cart\Cart::class)->name('cart');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', \App\Livewire\Products\Products::class)->name('index');
    Route::get('/show/{slug}', \App\Livewire\Products\Show::class)->name('show');
});

// khusus sudah login
Route::prefix('account')->name('account.')->group(function () {
    Route::get('/profile', \App\Livewire\Account\Profile::class)->name('profile');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', \App\Livewire\Dashboard\Dashboard::class)->name('index');
});
