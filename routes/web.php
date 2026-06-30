<?php

use App\Http\Middleware\RunningBroccoli;
use Illuminate\Support\Facades\Route;

Route::middleware(RunningBroccoli::class)->group(function () {
    require __DIR__.'/broccoli.php';
});
Route::get('/products', \App\Livewire\Product::class)->name('products');
Route::get('/login', \App\Livewire\Auth::class)->name('login');
Route::get('/register', \App\Livewire\Auth::class)->name('register');