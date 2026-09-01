<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="font-poppins font-bold text-2xl md:text-3xl text-gray-800 flex items-center gap-2">
            🔥 Trending Products
        </h2>
        <a href="{{ route('products') }}" 
           class="flex items-center gap-2 px-5 py-2.5 bg-[#389436] text-white font-poppins font-medium rounded-full hover:bg-[#2d7a2b] transition text-sm">
            View More
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div wire:key="product-{{ $product->id }}" class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition group">
                <a href="{{ route('products.show', $product) }}" class="w-full">
                    <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden w-full bg-gray-100">
              
                                  @if($product->image)
                            <!-- ✅ Using single image field -->
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="object-cover w-full h-full group-hover:scale-105 transition duration-300">
                        @else
                            <!-- Default image if no image exists -->
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-100">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <span class="text-sm font-inter">No Image</span>
                            </div>
                        @endif
                    </div>
                </a>
                <div class="mt-2 w-full">
                    <h3 class="text-lg font-medium font-poppins text-center truncate">{{ $product->name }}</h3>
                    <h4 class="font-bold text-md font-poppins text-highlight text-center">
                        NPR.{{ number_format($product->price, 0) }}
                    </h4>
                </div>

                <button wire:click="addToCart({{ $product->id }})" 
                        class="rounded-full w-8 h-8 bg-[#389436] flex items-center justify-center mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
            </div>
        @empty
            <div class="col-span-full text-center py-16 font-poppins text-gray-500">
                No products available.
            </div>
        @endforelse
    </div>

    <!-- Success/Error Messages -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg z-50 shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg z-50 shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
