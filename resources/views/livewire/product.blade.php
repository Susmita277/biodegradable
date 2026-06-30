<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- FILTER SIDEBAR : 1 grid column --}}
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-5 border border-gray-200 sticky top-6">
                <h3 class="font-poppins font-medium text-lg mb-4">Filters</h3>

                {{-- Category Filter --}}
                <div class="mb-6">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Category</h4>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                            <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">Paper Bags</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                            <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">Food Containers</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                            <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">Cutlery</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                            <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">Straws</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                            <span class="font-poppins text-sm text-gray-600 group-hover:text-gray-900">Packaging Boxes</span>
                        </label>
                    </div>
                </div>

                <hr class="border-gray-200 mb-6">

                {{-- Price Range Filter --}}
                <div class="mb-6">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Price range</h4>
                    <div class="flex items-center gap-2 mb-3">
                        <input type="number" placeholder="Min"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        <span class="text-gray-400">-</span>
                        <input type="number" placeholder="Max"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                    </div>
                    <input type="range" min="0" max="5000" step="50" class="w-full accent-[#389436]">
                </div>

                <hr class="border-gray-200 mb-6">

                {{-- Sort Filter --}}
                <div class="mb-2">
                    <h4 class="font-poppins font-medium text-sm text-gray-700 mb-3">Sort by</h4>
                    <select class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        <option>Latest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Most popular</option>
                    </select>
                </div>

                <button class="w-full mt-6 py-2 rounded-full border border-gray-300 font-poppins text-sm text-gray-600 hover:bg-gray-50 transition">
                    Clear filters
                </button>
            </div>
        </aside>

        {{-- PRODUCT GRID : 3 grid columns --}}
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-poppins font-medium text-xl">6 products</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                {{-- Product 1 --}}
                <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                    <a href="#" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">3D Paper Bag</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                            NPR.200/ <span class="text-gray-500">kg</span>
                        </h4>
                    </div>
                    <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                    </div>
                </div>

                {{-- Product 2 --}}
                <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                    <a href="#" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">Bamboo Food Box</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                            NPR.350/ <span class="text-gray-500">pc</span>
                        </h4>
                    </div>
                    <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                    </div>
                </div>

                {{-- Product 3 --}}
                <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                    <a href="#" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">Wooden Cutlery Set</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                            NPR.150/ <span class="text-gray-500">set</span>
                        </h4>
                    </div>
                    <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                    </div>
                </div>

                {{-- Product 4 --}}
                <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                    <a href="#" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">Paper Straws (50pc)</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                            NPR.120/ <span class="text-gray-500">pack</span>
                        </h4>
                    </div>
                    <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                    </div>
                </div>

                {{-- Product 5 --}}
                <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                    <a href="#" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">Compostable Box</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                            NPR.400/ <span class="text-gray-500">pc</span>
                        </h4>
                    </div>
                    <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                    </div>
                </div>

                {{-- Product 6 --}}
                <div class="bg-white rounded-3xl p-5 flex flex-col items-center relative border border-gray-200 hover:border-[#389436] transition">
                    <a href="#" class="w-full">
                        <div class="h-[200px] cursor-pointer rounded-xl overflow-hidden">
                            <img src="https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500"
                                class="object-cover w-full h-full">
                        </div>
                    </a>
                    <div class="mt-2 w-full">
                        <h3 class="text-lg font-medium font-poppins text-center truncate">Jute Carry Bag</h3>
                        <h4 class="font-bold text-md font-poppins text-highlight text-center">
                            NPR.250/ <span class="text-gray-500">pc</span>
                        </h4>
                    </div>
                    <div class="rounded-full w-8 h-8 bg-[#389436] items-center justify-center flex mt-4 cursor-pointer hover:bg-[#2d7a2b] transition">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-white" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>