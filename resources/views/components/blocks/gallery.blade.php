@props(['block'])
@php
    $data = data_get($block, 'data');
@endphp

<div class="grid grid-cols-4 py-12 gap-4 lg:px-40 2xl:px-50 px-5 2xl:py-14">
    <x-product-card />
    <x-product-card />
    <x-product-card />
    <x-product-card />
</div>

