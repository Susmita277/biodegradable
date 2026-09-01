<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="font-poppins font-medium text-2xl mb-6">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl p-6 border border-gray-200">
                <h3 class="font-poppins font-medium text-lg mb-4">Delivery Details</h3>

                <div class="space-y-4">
                    <div>
                        <label class="font-poppins text-sm text-gray-700 mb-1 block">Full Name</label>
                        <input type="text" wire:model="full_name"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        @error('full_name') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-poppins text-sm text-gray-700 mb-1 block">Phone Number</label>
                        <input type="text" wire:model="phone" placeholder="98XXXXXXXX"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                        @error('phone') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-poppins text-sm text-gray-700 mb-1 block">District</label>
                        <select wire:model.live="district_id"
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                            <option value="">Select district</option>
                            @foreach ($this->districts as $province => $districtGroup)
                                <optgroup label="{{ $province }}">
                                    @foreach ($districtGroup as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('district_id') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-poppins text-sm text-gray-700 mb-1 block">Full Address</label>
                        <textarea wire:model="address" rows="3" placeholder="Street, ward, landmark..."
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]"></textarea>
                        @error('address') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-poppins text-sm text-gray-700 mb-1 block">Notes (optional)</label>
                        <textarea wire:model="notes" rows="2" placeholder="Delivery instructions..."
                            class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]"></textarea>
                    </div>
                </div>

                <hr class="border-gray-200 my-6">
                <h3 class="font-poppins font-medium text-lg mb-3">Payment Method</h3>

<!-- COD Option -->
<label class="flex items-center gap-2 p-3 rounded-lg border border-[#389436] bg-[#389436]/5 cursor-pointer mb-2">
    <input type="radio" wire:model="payment_method" value="cod" class="text-[#389436] focus:ring-[#389436]">
    <span class="font-poppins text-sm">Cash on Delivery</span>
</label>

<!-- eSewa Option -->
<label class="flex items-center gap-2 p-3 rounded-lg border border-gray-200 hover:border-[#389436] cursor-pointer transition {{ $payment_method === 'esewa' ? 'border-[#389436] bg-[#389436]/5' : '' }}">
    <input type="radio" wire:model="payment_method" value="esewa" class="text-[#389436] focus:ring-[#389436]">
    <span class="font-poppins text-sm">eSewa</span>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Esewa_logo.png/120px-Esewa_logo.png" 
         alt="eSewa" class="h-5 ml-auto">
</label>


               
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-6 border border-gray-200 sticky top-6">
                <h3 class="font-poppins font-medium text-lg mb-4">Order Summary</h3>

                <div class="space-y-2 mb-4 max-h-48 overflow-y-auto">
                    @foreach ($this->items as $item)
                        <div class="flex justify-between font-poppins text-sm text-gray-600">
                            <span class="truncate pr-2">{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span class="flex-shrink-0">NPR.{{ number_format($item->subtotal, 0) }}</span>
                        </div>
                    @endforeach
                </div>

                <hr class="border-gray-200 mb-4">

                <div class="flex justify-between font-poppins text-sm text-gray-600 mb-2">
                    <span>Subtotal</span>
                    <span>NPR.{{ number_format($this->subtotal, 0) }}</span>
                </div>
                <div class="flex justify-between font-poppins text-sm text-gray-600 mb-4">
                    <span>Delivery</span>
                    <span>{{ $this->district_id ? 'NPR.'.number_format($this->deliveryCharge, 0) : 'Select district' }}</span>
                </div>

                <hr class="border-gray-200 mb-4">

                <div class="flex justify-between font-poppins font-bold text-lg mb-6">
                    <span>Total</span>
                    <span class="text-highlight">NPR.{{ number_format($this->total, 0) }}</span>
                </div>

                @error('stock') <p class="text-red-500 text-xs font-poppins mb-3">{{ $message }}</p> @enderror

                <button wire:click="placeOrder" wire:loading.attr="disabled"
                    class="w-full py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition disabled:opacity-60">
                    <span wire:loading.remove wire:target="placeOrder">
                        @if($payment_method === 'esewa')
                            Pay with eSewa
                        @else
                            Place Order
                        @endif
                    </span>
                    <span wire:loading wire:target="placeOrder">Processing...</span>
                </button>

                @if($payment_method === 'esewa')
                    <p class="text-center text-xs text-gray-400 mt-3 font-poppins">
                        🔒 Secure payment via eSewa
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
