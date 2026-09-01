<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <aside class="lg:col-span-1">
            <form action="{{ route('products.index') }}" method="GET" class="bg-white rounded-3xl p-5 border border-gray-200 sticky top-6">
                <h3 class="font-poppins font-medium text-lg mb-4">Filters</h3>

                <div class="mb-6">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Category</h4>
                    <div class="space-y-2">
                        @foreach ($materials as $material)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="materials[]" value="{{ $material }}" {{ in_array($material, request()->input('materials', []), true) ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                                <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">{{ $material }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <hr class="border-gray-200 mb-6">

                <div class="mb-6">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Price range</h4>
                    <div class="flex items-center gap-2 mb-3">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        <span class="text-gray-400">-</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                    </div>
                </div>

                <hr class="border-gray-200 mb-6">

                <div class="mb-2">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Sort by</h4>
                    <select name="sort" class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                        <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low to High</option>
                        <option value="price_high" @selected(request('sort') === 'price_high')>Price: High to Low</option>
                    </select>
                </div>

                <button type="submit" class="w-full mt-6 py-2 rounded-full border border-[#389436] bg-[#389436] font-poppins text-sm text-white hover:bg-[#2d7a2b] transition">Apply filters</button>
                <a href="{{ route('products.index') }}" class="block w-full mt-3 py-2 rounded-full border border-gray-300 font-poppins text-sm text-gray-600 hover:bg-gray-50 transition text-center">Clear filters</a>
            </form>
        </aside>

        <div class="lg:col-span-3">
            @if (request()->hasAny(['materials', 'min_price', 'max_price', 'sort']))
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    @foreach (request()->input('materials', []) as $material)
                        <span class="rounded-full bg-green-50 px-3 py-1 font-poppins text-sm text-[#389436]">{{ $material }}</span>
                    @endforeach
                    @if (request('min_price'))
                        <span class="rounded-full bg-green-50 px-3 py-1 font-poppins text-sm text-[#389436]">Min: NPR {{ request('min_price') }}</span>
                    @endif
                    @if (request('max_price'))
                        <span class="rounded-full bg-green-50 px-3 py-1 font-poppins text-sm text-[#389436]">Max: NPR {{ request('max_price') }}</span>
                    @endif
                    @if (request('sort') && request('sort') !== 'latest')
                        <span class="rounded-full bg-green-50 px-3 py-1 font-poppins text-sm text-[#389436]">Sort: {{ str(request('sort'))->replace('_', ' ')->title() }}</span>
                    @endif
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h2 class="font-poppins font-medium text-xl">{{ $products->count() }} products</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                        <a href="#" class="w-full">
                            <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                                <img src="{{ $product->primaryImage?->path }}" class="object-cover w-full h-full" alt="{{ $product->name }}">
                            </div>
                        </a>
                        <div class="mt-2 w-full">
                            <h3 class="text-lg font-medium font-poppins text-center truncate">{{ $product->name }}</h3>
                            <h4 class="font-bold text-md font-poppins text-highlight text-center">NPR.{{ number_format($product->price, 2) }}</h4>
                        </div>
                        <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                            <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                        </div>
                    </div>
                @endforeach

                @if ($products->isEmpty())
                    <p class="font-poppins text-gray-600 sm:col-span-2 xl:col-span-3">No products match these filters.</p>
                @endif
            </div>

            <div class="fixed bottom-6 right-6 bg-white rounded-full p-4 shadow-lg border border-gray-200">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
