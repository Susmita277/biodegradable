@props(['block'])
@php
    $data = data_get($block, 'data');
    $heading = data_get($data, 'heading');
    $description = data_get($data, 'description');
    $button_label = data_get($data, 'button_label');
    $button_url = data_get($data, 'button_url');
    $image = data_get($data, 'image');
@endphp
<div
    class="lg:mx-40 2xl:mx-50 m-5 flex justify-center items-end relative    items-center 2xl:h-[550px] lg:h-[420px] h-[300px]  rounded-xl bg-gradient-to-r from-[#389537] via-green-200 to-[#389537] ">
    <div class="w-full 2xl:h-[550px] lg:h-[420px] h-[300px] bg-[#389537]/20 absolute  flex justify-center rounded-xl">
        <div class=" mt-10 lg:w-[40%] w-[90%]  ">
            <div>
                <h2 class="font-poppins  leading-relaxed text-white text-center">
                    {{ $heading }}
                </h2>
                <p
                    class=" lg:!text-sm/8 text-sm/4 2xl:!text-xl/8 font-inter tracking-wide leading-relaxed py-2 text-white text-center">
                    {{ $description }}
                </p>
                <div class="flex justify-center">
                    <a href="{{$button_url}}">
                        <div class="flex gap-2 btn secondary !h-8 mt-8 w-fit 2xl:!h-10">
                            <p>{{ $button_label }}</p>
                            <div class="w-6 h-6 flex justify-center items-center rounded-full bg-black/15">
                                <x-heroicon-o-arrow-right class="w-4 h-4" />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class=" h-[300px] 2xl:h-[400px] flex items-end">
        <img src="{{broccoli_asset($image)}}" class="w-full h-full object-cover">
    </div>
</div>
