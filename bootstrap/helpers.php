<?php

if (! function_exists('broccoli_asset')) {
    function broccoli_asset($path)
    {
        return asset('broccoli-media/'.$path);
    }
}
