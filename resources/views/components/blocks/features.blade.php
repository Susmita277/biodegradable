    @props(['block'])
    {{-- @dd($block); --}}

    @php
        $data = data_get($block, 'data');
        $heading = data_get($data, 'heading');
        $description = data_get($data, 'description');
        $features = data_get($data, 'features');
    @endphp
    {{-- @dd($image); --}}

    <div class="lg:py-12 lg:px-40 2xl:px-50 p-5 w-full 2xl:py-14 " >
        <div class=" text-center">
            <h2 class="font-poppins">{{ $heading }}</h2>
            <p
                class="lg:!text-sm/8 text-sm/4  2xl:!text-xl/8 tracking-wide leading-relaxed lg:px-[25%] py-2 2xl:py-3 2xl:px-[30%]">
                {{$description}}
            </p>
        </div>
        <div class="flex justify-center">
            <div class="grid lg:grid-cols-3 lg:gap-10 lg:pt-12 pt-6 grid-cols-1 gap-y-4 lg:gap-y-0 ">
                @foreach ($features as $feature)
                    <div class="flex flex-col items-center">
                            <div class="w-[80px] h-[80px] 2xl:w-[100px] 2xl:h-[100px]">
                                <img src="{{broccoli_asset($feature['image'])}}" class="w-full h-full object-cover" alt="plastic">
                            </div>
                        <div class="mt-8 2xl:mt-12">
                            <h3 class="font-poppins text-center">{{ $feature['title'] }}</h3>
                            <p
                                class="text-center lg:!text-xs/4 text-sm/4 2xl:!text-xl/8 font-inter tracking-wide leading-relaxed py-2 text-gray-500">
                                {{ $feature['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
