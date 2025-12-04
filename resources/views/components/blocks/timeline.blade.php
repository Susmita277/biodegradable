@props(['block'])
@php
    $data = data_get($block ,'data');
    $histories = data_get($data,'history');
@endphp

<div class="lg:px-40 lg:py-12 2xl:px-50 px-5 py-6 2xl:py-14 ">
    @foreach ($histories as $history)
        <div class="grid grid-cols-2 gap-12 relative w-full h-auto pb-4 lg:pb-10 2xl:pb-10">

            {{-- IMAGE COLUMN --}}
            <div
                class="lg:flex items-center justify-end hidden
                       {{ $loop->even ? 'lg:order-2 lg:justify-start' : 'lg:order-1' }}">
                <div class="lg:w-[200px] lg:h-[200px] w-[150px] h-[150px] 2xl:w-[300px] 2xl:h-[300px] border border-gray-200 rounded-full overflow-hidden">
                    <img src="{{ broccoli_asset($history['avatar']) }}" class="object-cover w-full h-full">
                </div>
            </div>

            {{-- TEXT COLUMN --}}
            <div class="lg:min-h-[200px] w-full h-fit cursor-pointer
                        {{ $loop->even ? 'lg:order-1' : 'lg:order-2' }}">
                <div class="flex gap-4 {{ $loop->even ? 'lg:justify-end' : '' }}">
                    <div class="w-8 h-8 rounded-full text-lg text-white flex justify-center bg-[#389537] items-center lg:hidden md:hidden">
                        1
                    </div>
                    <h3 class="text-gray-800 pb-2 font-poppins">{{ $history['title'] }}</h3>
                </div>

                <div>
                    <p class="my-2 lg:!text-sm/8 text-sm/4 2xl:!text-xl/8 font-inter tracking-wide leading-relaxed py-2 text-gray-500">
                        {{ $history['description'] }}
                    </p>
                </div>
            </div>

            {{-- LINE + DOT --}}
            <div class="absolute w-1 h-full bg-gray-200 left-[50%] 2xl:left-[50%] hidden md:flex lg:flex"></div>
            <div class="absolute w-4 h-4 rounded-full bg-[#389537] lg:left-[49.5%] left-[49%] top-2 hidden md:flex lg:flex"></div>
        </div>
    @endforeach
</div>
