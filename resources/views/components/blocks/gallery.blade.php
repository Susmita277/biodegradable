@props(['block'])
@php
    $data = data_get($block, 'data');
    $heading = data_get($data, 'heading');
    $description = data_get($data, 'description');
    $images = data_get($data, 'images');

@endphp

{{-- highlighted products --}}
<div class="lg:p-12  p-5">
    <div class=" text-center">
        <h2 class="font-poppins">{{ $heading }}</h2>
        <p
            class="lg:!text-sm/8 text-sm/4  2xl:!text-xl/8 tracking-wide leading-relaxed lg:px-[25%] py-2 2xl:py-3 2xl:px-[30%]">
            {{ $description }}
        </p>
    </div>
    <div class="swiper SliderOne  !pt-8 !pb-10 ">
        <div class="swiper-wrapper ">
            @foreach ($images as $image)
                <div
                    class="swiper-slide lg:!w-[220px] lg:!h-[220px] !w-[200px] !h-[200px] 2xl:!w-[320px] 2xl:!h-[320px] rounded-2xl !overflow-hidden ">
                    <img src="{{ broccoli_asset($image) }}" class="object-cover h-full w-full" alt="products">
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination !pt-8"></div>

    </div>

</div>
