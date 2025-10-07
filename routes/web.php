<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::get('/products', \App\Livewire\Category\Category::class)->name('products');
Route::get('/categories', \App\Livewire\Product\Product::class)->name('categories');
