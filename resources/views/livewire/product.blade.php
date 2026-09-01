<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- FILTER SIDEBAR --}}
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-5 border border-gray-200 sticky top-6">
                <h3 class="font-poppins font-medium text-lg mb-4">Filters</h3>

                {{-- Category Filter --}}
                <div class="mb-6">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Category</h4>
                    <div class="space-y-2">
                        @foreach ($this->categories as $category)
                            <label class="flex items-center gap-2 cursor-pointer group" wire:key="cat-{{ $category->id }}">
                                <input type="checkbox"
                                    wire:model.live="selectedCategories"
                                    value="{{ $category->id }}"
                                    class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                                <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <hr class="border-gray-200 mb-6">

                {{-- Price Range Filter --}}
                <div class="mb-6">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Price range</h4>
                    <div class="flex items-center gap-2 mb-3">
                        <input type="number" wire:model.live.debounce.500ms="minPrice" placeholder="Min"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        <span class="text-gray-400">-</span>
                        <input type="number" wire:model.live.debounce.500ms="maxPrice" placeholder="Max"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                    </div>
                    <input type="range" wire:model.live="maxPrice" min="0" max="5000" step="50" class="w-full accent-[#389436]">
                </div>

                <hr class="border-gray-200 mb-6">

                {{-- Sort Filter --}}
                <div class="mb-2">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Sort by</h4>
                    <select wire:model.live="sortBy" class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        <option value="latest">Latest</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="popular">Most popular</option>
                    </select>
                </div>

                <button wire:click="clearFilters" class="w-full mt-6 py-2 rounded-full border border-gray-300 font-poppins text-sm text-gray-600 hover:bg-gray-50 transition">
                    Clear filters
                </button>
            </div>
        </aside>

        {{-- PRODUCT GRID --}}
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-poppins font-medium text-xl">{{ $this->products->total() }} products</h2>
            </div>

            <div wire:loading.class="opacity-50" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 transition-opacity">
                @forelse ($this->products as $product)
                    <div wire:key="product-{{ $product->id }}" class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                        <a href="{{ route('products.show', $product) }}" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">Wooden Cutlery Set</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                         NPR.{{ number_format($product->price, 0) }} <span class="text-gray-500">/{{$product->unit}}</span>
                        </h4>
                        </div>

                        <div wire:click="addToCart({{ $product->id }})" class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 font-poppins text-gray-500">
                        No products match these filters.
                    </div>
                @endforelse
                </div>

            <div class="mt-8">
                {{ $this->products->links() }}
            </div>
        </div>
    </div>
</div>