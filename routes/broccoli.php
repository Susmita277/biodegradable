<?php

/**
 * @see Route
 * This docblock is added so that pint doesn't remove this route as unused import when formatting the code.
 */
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::get('/contact', \App\Livewire\Contact::class)->name('contact');
Route::get('/about', \App\Livewire\About::class)->name('about');
Route::get('/why-us', \App\Livewire\WhyUs::class)->name('why-us');
Route::get('/product', \App\Livewire\Product::class);
Route::get('/auth', \App\Livewire\Auth::class);