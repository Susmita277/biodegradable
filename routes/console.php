<?php

use App\Models\Page;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    dd(Page::latest('id')->first()->toArray());
})->purpose('Display an inspiring quote');
