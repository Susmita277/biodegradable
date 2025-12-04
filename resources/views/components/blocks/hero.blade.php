@props(['block'])
@php
    $data = data_get($block, 'data');
    $title = data_get($data, 'title');
    $subtitle = data_get($data, 'subtitle');
    $icon1 = data_get($data, 'icon1');
    $icon2 = data_get($data, 'icon2');
    $icon3 = data_get($data, 'icon3');
    $icon4 = data_get($data, 'icon4');
    $icon5 = data_get($data, 'icon5');
    $button_label = data_get($data, 'button_label');
    $button_url = data_get($data, 'button_url');
    $background_image_desktop = broccoli_asset(data_get($data, 'background_image_desktop'));
    $background_image_mobile = broccoli_asset(data_get($data, 'background_image_mobile'));
    $leftsideimages = data_get($data, 'leftsideimages');
    $rightsideimages = data_get($data, 'rightsideimages');
    $buttons = data_get($data, 'buttons');
@endphp

<div class="pb-12 2xl:pb-14">
    <div class=" flex justify-center relative ">
        <div class="lg:w-[60%] md:[50%] w-full p-5 lg:px-12 lg:py-12 ">
            <div class="grid place-items-center ">
                <div class="p-1 rounded-full  border border-gray-200 flex gap-1 justify-center w-fit mb-4 lg:mb-0">
                    <x-dynamic-component :component="$icon1" class="2xl:w-7 2xl:h-7 w-5 h-5 text-yellow-500" />
                    <x-dynamic-component :component="$icon2" class="2xl:w-7 2xl:h-7 w-5 h-5 text-gray-700" />
                    <x-dynamic-component :component="$icon3" class="2xl:w-7 2xl:h-7 w-5 h-5 text-[#389537]" />

                    <p>Clean environments</p>
                    <x-dynamic-component :component="$icon4" class="2xl:w-7 2xl:h-7 w-5 h-5 text-gray-700" />
                    <x-dynamic-component :component="$icon5" class="2xl:w-7 2xl:h-7 w-5 h-5 text-[#389537]" />
                </div>

                <h1 class="text-center py-2 font-poppins">{{ $title }}</h1>
                <p
                    class="text-gray-500 text-center lg:!text-sm/8 text-sm/4 2xl:!text-xl/8 tracking-wide leading-relaxed lg:px-[20%] md:px-[15%] px-[5%] py-2 ">
                    {{ $subtitle }}</p>

                <div class="flex gap-2 items-center justify-center mt-4">
                    @foreach ($buttons as $button)
                        <a href="{{ $button['button_url'] }}">
                            <div
                                class="flex gap-2 btn  !h-8 2xl:!h-10 
                {{ $loop->even ? 'bg-white text-black flex-row-reverse' : 'bg-[#389537] text-white' }}">
                                <x-dynamic-component :component="$button['button_icon']" class="2xl:w-7 2xl:h-7 w-5 h-5" />

                                <p>{{ $button['button_label'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
            <div class="lg:flex md:flex justify-center hidden">
                <div>
                    <img src="{{ $background_image_desktop }}"
                        class="w-full lg:h-[380px] md:h-[350px] h-[250px] 2xl:h-[600px] object-cover " />
                </div>
            </div>
        </div>

        <div
            class="lg:flex md:flex hidden flex-col justify-center text-center items-start lg:text-left absolute lg:left-0 -left-5 opacity-75 lg:top-[41%] top-[55%] 2xl:top-[36%]">

            @foreach ($leftsideimages[0]['image'] as $index => $item)
                @php
                    //  variation
                    $rotations = ['-rotate-12', 'rotate-6', 'rotate-6'];
                    $margins = ['lg:ml-0 ml-0', 'lg:ml-26 ml-10', 'lg:ml-8 ml-0'];
                    $marginTops = ['lg:-mt-0 -mt-0', 'lg:-mt-[3rem] -mt-[2rem]', 'lg:-mt-[3rem] -mt-[2rem]'];

                    // Fallback values if images > 3
                    $rotation = $rotations[$index] ?? '-rotate-6';
                    $margin = $margins[$index] ?? 'lg:ml-0 ml-0';
                    $marginTop = $marginTops[$index] ?? 'lg:-mt-[2rem] -mt-[1rem]';
                @endphp

                <div
                    class="flex lg:justify-center
               lg:w-36 lg:h-36 h-28 w-28
                2xl:w-56 2xl:h-56
                rounded-full bg-transparent border-gray-200 border overflow-hidden
                transform {{ $rotation }} {{ $margin }} {{ $marginTop }}">
                    <img src="{{ broccoli_asset($item) }}" class="w-full h-full object-contain" />
                </div>
            @endforeach

        </div>
        <div
            class=" flex-col lg:flex md:flex hidden  justify-center text-center items-end lg:text-right lg:right-0 -right-5 absolute opacity-75 lg:top-[41%] top-[55%] 2xl:top-[36%]">

            @foreach ($rightsideimages[0]['image'] as $index => $item)
                @php
                    //variation
                    $rotations = ['-rotate-12', 'rotate-6', 'rotate-6'];
                    $margins = ['lg:ml-0 ml-0', 'lg:mr-26 mr-10', 'lg:m-8 ml-0'];
                    $marginTops = ['lg:-mt-0 -mt-0', 'lg:-mt-[3rem] -mt-[1.5rem]', 'lg:-mt-[3rem] -mt-[2rem]'];

                    // Fallback values if images > 3
                    $rotation = $rotations[$index] ?? '-rotate-6';
                    $margin = $margins[$index] ?? 'lg:ml-0 ml-0';
                    $marginTop = $marginTops[$index] ?? 'lg:-mt-[2rem] -mt-[1rem]';
                @endphp

                <div
                    class="flex lg:justify-center
                lg:w-36 lg:h-36 h-28 w-28
                2xl:w-56 2xl:h-56
                rounded-full bg-transparent border-gray-200 border overflow-hidden
                transform {{ $rotation }} {{ $margin }} {{ $marginTop }} ">
                    <img src="{{ broccoli_asset($item) }}" class="w-full h-full object-contain" />
                </div>
            @endforeach

        </div>

    </div>

</div>
