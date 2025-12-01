<?php

use App\Http\Middleware\RunningBroccoli;
use Illuminate\Support\Facades\Route;

Route::middleware(RunningBroccoli::class)->group(function () {
    require __DIR__.'/broccoli.php';
});
