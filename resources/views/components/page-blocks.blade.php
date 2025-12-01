@props(['blocks'])
@foreach ($blocks as $block)
    @php
        $component = 'blocks.' . data_get($block, 'type');
    @endphp

    @if (view()->exists('components.' . $component))
        <x-dynamic-component :component="$component" :block="$block" />
    @else
        <div class="text-red-500 bg-red-50 p-4 rounded-lg my-2">
            ⚠️ Missing view for block type: <strong>{{ data_get($block, 'type') }}</strong>
        </div>
    @endif
@endforeach
