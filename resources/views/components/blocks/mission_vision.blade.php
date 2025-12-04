@props(['block'])
@php
    $data = data_get($block, 'data');
    $heading = data_get($data, 'heading');
    $description = data_get($data, 'description');
    $missions = data_get($data, 'missions');
    $mission_visions = data_get($data, 'mission_visions');
@endphp

<div class="lg:pt-12 lg:px-40 2xl:px-50 p-5">
    <div class=" text-center">
        <h2 class="font-poppins leading-relaxed">{{ $heading }}</h2>
        <p class="lg:!text-sm/8 text-sm/4 2xl:!text-xl/8 tracking-wide leading-relaxed lg:px-[25%] py-2">
            {{ $description }}
        </p>
    </div>
    <div
        class="relative bg-white  grid lg:grid-cols-2 grid-cols-1  lg:h-min-[320px] lg:h-max-fit  rounded-3xl mt-[120px]  lg:py-[10%] 2xl:py-[15%]  lg:gap-[15%] px-[5%]">
        <div
            class="bg-[#389537] absolute -top-[100px] lg:h-[200px] 2xl:h-[300px]  lg:left-[20%] lg:right-[20%] -left-2 -right-2 rounded-3xl ">
            <div class="w-full flex justify-between lg:px-12 px-5 gap-4">
                @foreach ($missions as $index => $mission)
                    <div
                        class="flex  flex-col 
                        {{ in_array($index, [1, 2]) ? 'lg:mt-[115px] 2xl:mt-[205px]' : 'mt-2' }}">

                        <div class="lg:w-10 lg:h-10 2xl:h-12 2xl:w-12 w-8 h-8 overflow-hidden mt-0 2xl:mt-2">
                            <img src="{{ broccoli_asset($mission['image']) }}" alt="mission"
                                class="w-full h-full object-cover ">
                        </div>

                        <h5 class="text-white font-normal font-poppins text-md tracking-wide my-2">
                            {{ $mission['title'] }}
                        </h5>
                    </div>
                @endforeach

            </div>
        </div>

        @foreach ($mission_visions as $item)
            <div class="lg:mt-10 mt-40 w-full">
                <div class="flex gap-1 items-center ">
                    <div class="w-6 h-6 ">
                        <img src="{{broccoli_asset($item['image'])}}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-poppins text-center text-[#389537]">{{$item['title']}}</h3>

                </div>
                <p
                    class="my-2 lg:!text-sm/8 text-sm/4 font-inter tracking-wide leading-relaxed py-2 text-gray-700 2xl:!text-xl/8">
                    {{$item['description']}}
                 </p>
            </div>
        @endforeach
    </div>
</div>
