<div class="max-w-7xl mx-auto px-4 py-8">

    <nav class="font-poppins text-sm text-gray-500 mb-6">
        <a href="{{ route('products') }}" class="hover:text-[#389436]">Products</a>
        <span class="mx-2">/</span>
        <span>{{ $product->category->name }}</span>
        <span class="mx-2">/</span>
        <span class="text-gray-700">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- GALLERY --}}
        <div class="bg-white rounded-3xl p-5 border border-gray-200">
            <div class="h-[400px] rounded-xl overflow-hidden mb-4">
                <img src="{{ $this->selectedImage }}" class="object-cover w-full h-full transition">
            </div>

            @if (count($galleryImages) > 1)
                <div class="grid grid-cols-4 gap-3">
                    @foreach ($galleryImages as $index => $img)
                        <button wire:click="selectImage({{ $index }})" wire:key="thumb-{{ $index }}"
                            class="h-20 rounded-lg overflow-hidden border-2 transition {{ $selectedIndex === $index ? 'border-[#389436]' : 'border-gray-200 hover:border-gray-300' }}">
                            <img src="{{ asset('storage/'.$img) }}" class="object-cover w-full h-full">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- DESCRIPTION SIDE --}}
        <div class="bg-white rounded-3xl p-6 border border-gray-200 flex flex-col">
            <span class="inline-block w-fit px-3 py-1 rounded-full bg-[#389436]/10 text-[#389436] text-xs font-poppins font-medium mb-3">
                {{ $product->category->name }}
            </span>

            <h1 class="text-2xl font-poppins font-medium mb-2">{{ $product->name }}</h1>

            <h2 class="text-2xl font-bold font-poppins text-highlight mb-4">
                NPR.{{ number_format($product->price, 0) }} <span class="text-gray-500 text-base font-normal">/ {{ $product->unit }}</span>
            </h2>

            @if ($product->stock > 0)
                <p class="text-sm font-poppins text-[#389436] mb-4">In stock — {{ $product->stock }} {{ $product->unit }} available</p>
            @else
                <p class="text-sm font-poppins text-red-500 mb-4">Out of stock</p>
            @endif

            @if ($product->description)
                <p class="font-poppins text-sm text-gray-600 leading-relaxed mb-6">{{ $product->description }}</p>
            @endif

            @if (session()->has('message'))
                <div class="mb-4 px-4 py-2 rounded-lg bg-[#389436]/10 text-[#389436] text-sm font-poppins">
                    {{ session('message') }}
                </div>
            @endif

            @if ($product->stock > 0)
                <div class="flex items-center gap-4 mb-6">
                    <span class="font-poppins text-sm text-gray-700">Quantity</span>
                    <div class="flex items-center border border-gray-300 rounded-full">
                        <button wire:click="decrementQuantity" class="w-9 h-9 flex items-center justify-center text-gray-600 hover:text-[#389436]">-</button>
                        <span class="w-8 text-center font-poppins">{{ $quantity }}</span>
                        <button wire:click="incrementQuantity" class="w-9 h-9 flex items-center justify-center text-gray-600 hover:text-[#389436]">+</button>
                    </div>
                </div>

             
                        <button wire:click="buyNow" class="w-full py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition">
                    Buy Now
                </button>
            @else
                <button disabled class="w-full py-3 rounded-full bg-gray-200 text-gray-400 font-poppins font-medium cursor-not-allowed">
                    Out of Stock
                </button>
            @endif

            <a href="{{ route('products') }}" class="mt-4 text-sm font-poppins text-gray-500 hover:text-[#389436] text-center">
                ← Back to all products
            </a>
        </div>
    </div>

    @if ($this->relatedProducts->isNotEmpty())
        <div class="mt-14">
            <h3 class="font-poppins font-medium text-xl mb-6">You might also like</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                @foreach ($this->relatedProducts as $related)
                    <a href="{{ route('products.show', $related) }}" wire:key="related-{{ $related->id }}"
                        class="bg-white rounded-3xl p-5 flex flex-col items-center border border-gray-200 hover:border-[#389436] transition">
                        <div class="h-[150px] w-full rounded-xl overflow-hidden mb-2">
                            <img src="{{ $related->image ? asset('storage/'.$related->image) : 'https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500' }}"
                                class="object-cover w-full h-full">
                        </div>
                        <h4 class="text-sm font-medium font-poppins text-center truncate w-full">{{ $related->name }}</h4>
                        <p class="text-sm font-poppins font-bold text-highlight">NPR.{{ number_format($related->price, 0) }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>