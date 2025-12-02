@props(['block'])
    @php
        $data = data_get($block, 'data');
        $heading = data_get($data,'heading');
        $description = data_get($data, 'description');
        $process = data_get($data, 'process');

    @endphp
    <div class="lg:p-12 p-5">
        <div class=" text-center">
            <h2 class="font-poppins leading-relaxed">{{$heading}}</h2>
            <p class="lg:!text-sm/8 text-sm/8 tracking-wide leading-relaxed lg:px-[25%] py-2 2xl:!text-xl/8">
               {{$description}}
            </p>
        </div>
        <div class="grid lg:grid-cols-5 lg:gap-10 pt-8 grid-cols-2 gap-4">
              @foreach($process as $item)
            <div
                class=" h-[250px] 2xl:h-[350px] rounded-2xl overflow-hidden border border-gray-100 relative">
                <img src="{{broccoli_asset($item['image'])}}"
                    class="w-full h-full object-cover">
                <div
                    class="absolute top-0 right-0 bg-[#389737] text-center text-white lg:w-12 h-6 2xl:w-16 2xl:h-10 rounded-bl-2xl rounded-tr-2xl 2xl:!text-lg">
                    {{$item['days']}}</div>
            </div>
            @endforeach

        </div>
    </div>
    {{-- biodegredeable process end --}}
