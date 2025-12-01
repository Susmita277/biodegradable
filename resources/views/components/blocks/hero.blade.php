@props(['block'])
@php
    $data = data_get($block, 'data');
    $title = data_get($data, 'title');
    $subtitle = data_get($data, 'subtitle');
    $button_label = data_get($data, 'button_label');
    $button_url = data_get($data, 'button_url');
    $background_image_desktop = broccoli_asset(data_get($data, 'background_image_desktop'));
    $background_image_mobile = broccoli_asset(data_get($data, 'background_image_mobile'));
    $icon = 'hugeicons-activity-02';
@endphp

<div>
    <div>
        {{-- Background Image --}}
        <div class="hidden md:block">
            <img src="{{ $background_image_desktop }}" alt="{{ $title }}">
        </div>
        <div class="block md:hidden">
            <img src="{{ $background_image_mobile }}" alt="{{ $title }}" class="w-full h-auto object-cover">
        </div>

        <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $title }}</h1>

        <p class="text-lg md:text-2xl mb-6">{{ $subtitle }}</p>

        {{-- Button --}}
        @if ($button_label && $button_url)
            <a href="{{ $button_url }}"
                class="bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
                {{ $button_label }}
            </a>
        @endif
    </div>

</div>
