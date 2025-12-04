@props(['block'])
@php
    $data = data_get($block, 'data');
    $contents = data_get($data, 'content');
@endphp

<div>
    @foreach ($contents as $content)
        <div 
            class="lg:py-12 grid lg:grid-cols-2 grid-cols-1 gap-4 lg:px-40 p-5 2xl:px-50 2xl:py-14 
            {{ $loop->iteration % 2 == 0 ? 'lg:[&>*:first-child]:order-2' : '' }}">
            
            <!-- Image -->
            <div class="lg:flex items-center justify-center hidden">
                <div class="lg:h-[350px] 2xl:h-[450] rounded-full  ">
                    <img src="{{ broccoli_asset($content['avatar']) }}" class="w-full h-full object-cover object-center">
                </div>
            </div>

            <!-- Text -->
            <div>
                <h2 class="font-poppins mb-2">{{ $content['title'] }}</h2>
                <p class="text-gray-700 tracking-wide leading-relaxed lg:!text-sm/8 text-sm/4 2xl:!text-xl/8">
                    {{ $content['description'] }}
                </p>
            </div>
        </div>
    @endforeach
</div>
