<?php

use App\Http\Middleware\RunningBroccoli;
use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\UserProfile;
use Illuminate\Support\Facades\Auth;

// use App\Livewire\CartItems;

Route::middleware(RunningBroccoli::class)->group(function () {
    require __DIR__.'/broccoli.php';
});
Route::get('/products', \App\Livewire\Product::class)->name('products');
Route::get('/products/{product}', \App\Livewire\ProductDetail::class)->name('products.show');


Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::get('/cart', \App\Livewire\Cart::class)->name('cart')->middleware('auth');
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout')->middleware('auth');

Route::get('/orders', \App\Livewire\Order::class)->name('orders.index')->middleware('auth');
Route::get('/orders/{order}', \App\Livewire\Order::class)->name('orders.show')->middleware('auth');


    Route::get('/user/profile', UserProfile::class)->name('user.profile')->middleware('auth');
    Route::get('/user/orders', UserProfile::class)->name('user.orders')->middleware('auth');


Route::get('/esewa/redirect', [\App\Http\Controllers\EsewaController::class, 'redirect'])->name('esewa.redirect')->middleware('auth');
Route::get('/esewa/success', [\App\Http\Controllers\EsewaController::class, 'success'])->name('esewa.success');
Route::get('/esewa/failure', [\App\Http\Controllers\EsewaController::class, 'failure'])->name('esewa.failure');


 
 Route::post('/logout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout')->middleware('auth');
