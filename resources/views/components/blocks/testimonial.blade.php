@props(['block'])

@php
    $data = data_get($block, 'data');
    $heading = data_get($data, 'heading');
    $description = data_get($data, 'description');
    $testimonials = data_get($data, 'testimonials');
@endphp
{{-- testimonials --}}
<div class="lg:py-12 p-5 2xl:px-50 lg:px-40 2xl:py-14">
    <div class=" text-center">
        <h2 class="font-poppins leading-relaxed">{{ $heading }}</h2>
        <p class="lg:!text-sm/8 text-sm/4 tracking-wide leading-relaxed lg:px-[25%] py-2 2xl:!text-xl/8">
            {{ $description }}
        </p>
    </div>
    <div class="mt-8">

        <div class="swiper SliderThree  !pt-8 !pb-10 ">
            <div class="swiper-wrapper ">
                @foreach ($testimonials as $testi)
                    <div
                        class=" mb-4 
                    border border-gray-200 rounded-xl p-5 hover:shadow-md !overflow-hidden transition swiper-slide !h-auto !w-[320px] 2xl:!h-auto 2xl:!w-[500px]">

                        <div class="mb-4 flex gap-2">
                            <div class="bg-gray-200 rounded-full lg:w-14 lg:h-14 w-10 h-10 overflow-hidden">
                                <img src="{{ broccoli_asset($testi['author_image']) }}"
                                    class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h4>{{ $testi['author'] }}</h4>
                                <span class="text-gray-500">{{ $testi['position'] }}</span>
                            </div>
                        </div>
                        <p
                            class="lg:!text-sm/8 text-sm/4 tracking-wide leading-relaxed  py-2 2xl:!text-xl/8 text-gray-500">
                            {{ $testi['quote'] }}
                        </p>

                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination !pt-8 flex justify-center "></div>

        </div>


    </div>
</div>
