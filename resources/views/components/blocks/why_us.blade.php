@props(['block'])
@php
    $data = data_get($block, 'data');
    $title = data_get($data, 'title');
    $description = data_get($data, 'description');
    $image = data_get($data, 'image');

    // Split into two paragraphs
    $half = strlen($description) / 2;
    $para1 = trim(substr($description, 0, $half));
    $para2 = trim(substr($description, $half));
@endphp

<div class="grid grid-cols-3 py-12 gap-4 lg:px-40 2xl:px-50 px-5 2xl:py-14">
    <!-- Text Section -->
    <div class="w-full mt-6 lg:mt-0 col-span-2">
        <h2 class="pb-4 font-poppins">{{ $title }}</h2>

        <div class="text-gray-700 font-inter  space-y-4 2xl:pr-20">
            <p class="tracking-wide 2xl:tracking-wider leading-relaxed lg:pr-12 lg:!text-sm/8 text-sm/4 2xl:!text-xl/8">
                {{ $para1 }}.</p>
            <p class="tracking-wide 2xl:tracking-wider leading-relaxed lg:pr-12 lg:!text-sm/8 text-sm/4 2xl:!text-xl/8">
                {{ $para2 }}</p>
        </div>
    </div>

    <div>
        <div class="lg:flex items-center justify-center h-full  hidden">
            <img src="{{ broccoli_asset($image) }}"
                class="w-full  object-cover lg:h-[350px] 2xl:h-[450px] rounded-xl object-center">
        </div>
    </div>

</div>
