@props(['block'])
@php
    $data = data_get($block, 'data');
    $title = data_get($data, 'title');
    $subtitle = data_get($data, 'subtitle');
    $infos = data_get($data, 'infos');
@endphp



<div class="lg:px-40 lg:py-12 2xl:px-50 p-5 ">
    <div class="flex justify-center">
        <div class=" lg:w-[60%] w-full  text-center">
            <h2>{{ $title }}</h2>
            <p
                class="my-2 lg:!text-sm/8 font-inter tracking-wide leading-relaxed py-2 text-gray-500 text-sm/4 2xl:!text-xl/8">
                {{ $subtitle }}
            </p>
        </div>
    </div>
    <div class="py-8 grid lg:grid-cols-4 grid-cols-1 gap-4 2xl:gap-10 ">
        @foreach ($infos as $info)
            <div class="rounded-md p-5 shadow-sm">
                <div class="flex flex-col items-center justify-center">
                    {{-- <x-heroicon-o-map-pin class="text-[#389537] w-10 h-10" /> --}}
                    <x-dynamic-component :component="$info['icon']" class="2xl:w-10 2xl:h-10 lg:w-8 text-[#389537]" />
                    <div class="text-center pt-2">
                        <h6>{{ $info['title'] }}</h6>
                        <span class="text-gray-500">{{ $info['subtitle'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
