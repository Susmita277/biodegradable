<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="font-poppins font-medium text-2xl mb-6">Your Cart</h1>

    @if ($this->items->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-16 text-center">
            <p class="font-poppins text-gray-500 mb-4">Your cart is empty.</p>
            <a href="{{ route('products') }}" class="inline-block px-6 py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition">
                Browse Products
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- CART ITEMS --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach ($this->items as $item)
                    <div wire:key="cart-item-{{ $item->id }}" class="bg-white rounded-3xl p-4 border border-gray-200 flex items-center gap-4">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500' }}"
                                class="object-cover w-full h-full">
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="font-poppins font-medium truncate">{{ $item->product->name }}</h3>
                            <p class="font-poppins text-sm text-gray-500">NPR.{{ number_format($item->product->price, 0) }} / {{ $item->product->unit }}</p>
                        </div>

                        <div class="flex items-center border border-gray-300 rounded-full">
                            <button wire:click="decrementQuantity({{ $item->id }})" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-[#389436]">-</button>
                            <span class="w-8 text-center font-poppins text-sm">{{ $item->quantity }}</span>
                            <button wire:click="incrementQuantity({{ $item->id }})" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-[#389436]">+</button>
                        </div>

                        <div class="w-24 text-right font-poppins font-bold text-highlight">
                            NPR.{{ number_format($item->subtotal, 0) }}
                        </div>

                        <button wire:click="removeItem({{ $item->id }})" class="text-gray-400 hover:text-red-500 transition">
                            <x-heroicon-o-trash class="w-5 h-5" />
                        </button>
                    </div>
                @endforeach
            </div>

            {{-- ORDER SUMMARY --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-6 border border-gray-200 sticky top-6">
                    <h3 class="font-poppins font-medium text-lg mb-4">Order Summary</h3>

                    <div class="flex justify-between font-poppins text-sm text-gray-600 mb-2">
                        <span>Subtotal</span>
                        <span>NPR.{{ number_format($this->subtotal, 0) }}</span>
                    </div>
                    <div class="flex justify-between font-poppins text-sm text-gray-400 mb-4">
                        <span>Delivery</span>
                        <span>Calculated at checkout</span>
                    </div>

                    <hr class="border-gray-200 mb-4">

                    <div class="flex justify-between font-poppins font-bold text-lg mb-6">
                        <span>Total</span>
                        <span class="text-highlight">NPR.{{ number_format($this->subtotal, 0) }}</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="block text-center w-full py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition">
                        Proceed to Checkout
                    </a>

                    <a href="{{ route('products') }}" class="block text-center mt-3 text-sm font-poppins text-gray-500 hover:text-[#389436]">
                        ← Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>