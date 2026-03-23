@props(['block'])
@php
    $data = data_get($block, 'data');
    $heading = data_get($data, 'heading');
    $description = data_get($data, 'description');
    $members = data_get($data, 'members');
@endphp

<div class="lg:py-12 p-5 lg:px-40 2xl:px-50 2xl:py-14">
    <div class="text-center ">
        <h2 class="font-poppins leading-relaxed">{{ $heading }}</h2>
        <p class="lg:!text-sm/8 text-sm/4 2xl:!text-xl/8 tracking-wide leading-relaxed lg:px-[25%] py-2">
            {{ $description }}
        </p>
    </div>
    <div class="swiper SliderTwo  mt-16 !py-12 grid ">
        <div class="swiper-wrapper ">
            @foreach ($members as $member)
                <div class="swiper-slide ">
                    <div class="text-center group">
                        <div class="relative lg:w-44 lg:h-44 w-40 h-40 2xl:h-60 2xl:w-60 overflow-hidden mx-auto rounded-full ">
                            <img alt="Portrait of Dr. Aris Thorne"
                                class="w-full h-full  object-contain "
                                src="{{broccoli_asset($member['avatar'])}}" />
                            <div
                                class="absolute inset-0 rounded-full border-2 border-[#389537]/30 group-hover:border-[#389537] transition-colors duration-300">
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold  dark:text-zinc-100">{{ $member['name'] }}
                            </h3>
                            <p class="text-[#389537] font-medium">{{ $member['title'] }}</p>
                            <p class="mt-2 text-gray-500 dark:text-zinc-400 px-5">
                                {{ $member['quote'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="swiper-pagination "></div>

    </div>
</div>
