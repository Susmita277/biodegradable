@props(['block'])

@php
    $label = $block->button_label ?? 'Click Me';
    $url = $block->button_url ?? '#';
    $style = $block->button_style ?? 'primary';
    $target = $block->button_target ?? '_self';

    $classes = match ($style) {
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700',
        'success' => 'bg-green-600 text-white hover:bg-green-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        default => 'bg-blue-600 text-white hover:bg-blue-700',
    };
@endphp

<a href="{{ $url }}" target="{{ $target }}"
    class="inline-block px-5 py-3 rounded font-semibold transition {{ $classes }}">
    {{ $label }}
</a>
