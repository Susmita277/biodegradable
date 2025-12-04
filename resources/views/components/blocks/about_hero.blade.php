@props(['block'])
@php
    $data = data_get($block, 'data');
    $title = data_get($data, 'title');
    $description = data_get($data, 'description');
    $words = explode(' ', trim($title));//remove extra space splits sentence into seperatw words
    $lastWord = array_pop($words);// extract last word
    $firstPart = implode(' ', $words);//remove last words and join other words
@endphp

<div class=" flex justify-center realtive lg:py-12 p-5 2xl:py-14 ">
    <div class="lg:w-[60%] ">
        <div class="grid place-items-center ">

            <h1 class="text-center py-2 font-poppins">
                {{ $firstPart }}
                <span class="text-white bg-[#588534] inline-block -rotate-3 px-2 !text-3xl md:!text-4xl lg:!text-5xl 2xl:!text-7xl  !font-light  !tracking-tight lg:!leading-[1.3] rounded-md">
                    {{ $lastWord }}
                </span>
            </h1>

            <p class="text-gray-500 text-center lg:!text-sm/8 text-sm/4 tracking-wide leading-relaxed lg:px-[20%] my-2">
                {{ $description }}
        </div>
    </div>
</div>
