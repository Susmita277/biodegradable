{{-- resources/views/livewire/order.blade.php --}}
<div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="font-poppins font-medium text-2xl">Order Details</h1>
        <span class="font-poppins text-sm text-gray-500">Order #{{ $order->id }}</span>
    </div>

    {{-- Status Banner --}}
    @if($order->status === 'cancelled')
        <div class="bg-red-50 border border-red-200 rounded-3xl p-6 mb-6 flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div>
                <h3 class="font-poppins font-medium text-red-600">Order Cancelled</h3>
                <p class="font-poppins text-sm text-gray-600">This order has been cancelled.</p>
            </div>
        </div>
    @elseif($order->status === 'delivered')
        <div class="bg-green-50 border border-green-200 rounded-3xl p-6 mb-6 flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-[#389436]/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-[#389436]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <h3 class="font-poppins font-medium text-[#389436]">Order Delivered!</h3>
                <p class="font-poppins text-sm text-gray-600">Your order has been successfully delivered. Thank you for shopping with us!</p>
            </div>
        </div>
    @else
        <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6 mb-6 flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-poppins font-medium text-blue-600">Order {{ ucfirst($order->status) }}</h3>
                <p class="font-poppins text-sm text-gray-600">
                    @if($order->status === 'pending')
                        Your order is being processed. We'll update you soon!
                    @elseif($order->status === 'processing')
                        We're preparing your order for shipment.
                    @elseif($order->status === 'shipped')
                        Your order is on the way! Check the delivery status below.
                    @endif
                </p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Order Timeline (only if not cancelled) --}}
            @if($order->status !== 'cancelled')
                <div class="bg-white rounded-3xl p-6 border border-gray-200">
                    <h3 class="font-poppins font-medium text-lg mb-6">Order Status</h3>
                    
                    <div class="relative">
                        {{-- Progress Line --}}
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200">
                            @php
                                $statusOrder = ['pending', 'processing', 'shipped', 'delivered'];
                                $currentIndex = array_search($order->status, $statusOrder);
                                $progressPercentage = ($currentIndex / (count($statusOrder) - 1)) * 100;
                            @endphp
                            <div class="w-full bg-[#389436] transition-all duration-500" 
                                 style="height: {{ $progressPercentage }}%">
                            </div>
                        </div>

                        {{-- Steps --}}
                        <div class="space-y-8 relative">
                            @foreach ($this->statusSteps as $step)
                                <div class="flex items-start gap-4">
                                    <div class="relative z-10">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                                            {{ $step['completed'] ? 'bg-[#389436] text-white' : 'bg-gray-200 text-gray-400' }}
                                            {{ $step['active'] ? 'ring-4 ring-[#389436]/20' : '' }}">
                                            @if($step['completed'])
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @else
                                                <span class="text-xs font-poppins font-medium">{{ $loop->iteration }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-poppins font-medium text-sm 
                                            {{ $step['active'] ? 'text-[#389436]' : ($step['completed'] ? 'text-gray-700' : 'text-gray-400') }}">
                                            {{ $step['label'] }}
                                        </p>
                                        <p class="font-poppins text-xs text-gray-400">
                                            {{ $step['active'] ? 'Current status' : ($step['completed'] ? 'Completed' : 'Pending') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Delivery Information --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-200">
                <h3 class="font-poppins font-medium text-lg mb-4">Delivery Information</h3>
                <div class="space-y-2 font-poppins text-sm">
                    <p><span class="text-gray-500">Name:</span> {{ $order->full_name }}</p>
                    <p><span class="text-gray-500">Phone:</span> {{ $order->phone }}</p>
                    <p><span class="text-gray-500">Address:</span> {{ $order->address }}</p>
                    <p><span class="text-gray-500">District:</span> {{ $order->district->name ?? 'N/A' }}</p>
                    @if($order->notes)
                        <p><span class="text-gray-500">Notes:</span> {{ $order->notes }}</p>
                    @endif
                    <p><span class="text-gray-500">Order Date:</span> {{ $order->created_at->format('F d, Y g:i A') }}</p>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-6 border border-gray-200 sticky top-6">
                <h3 class="font-poppins font-medium text-lg mb-4">Order Summary</h3>

                <div class="space-y-3 mb-4 max-h-48 overflow-y-auto">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between font-poppins text-sm text-gray-600">
                            <span class="truncate pr-2">{{ $item->product_name }} × {{ $item->quantity }}</span>
                            <span class="flex-shrink-0">NPR.{{ number_format($item->subtotal, 0) }}</span>
                        </div>
                    @endforeach
                </div>

                <hr class="border-gray-200 mb-4">

                <div class="space-y-2 font-poppins text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>NPR.{{ number_format($order->subtotal, 0) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Delivery</span>
                        <span>NPR.{{ number_format($order->delivery_charge, 0) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Payment</span>
                        <span class="capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                    </div>
                </div>

                <hr class="border-gray-200 my-4">

                <div class="flex justify-between font-poppins font-bold text-lg mb-6">
                    <span>Total</span>
                    <span class="text-[#389436]">NPR.{{ number_format($order->total, 0) }}</span>
                </div>

                <div class="flex gap-2 flex-col">
                    @if($order->status === 'pending')
                        <button wire:click="cancelOrder" 
                                wire:confirm="Are you sure you want to cancel this order?"
                                class="w-full py-2 rounded-full border border-red-300 text-red-600 font-poppins text-sm hover:bg-red-50 transition">
                            Cancel Order
                        </button>
                    @endif

                    <a href="{{ route('products') }}" 
                       class="w-full py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition text-center">
                        Continue Shopping
                    </a>
                    <a href="{{ route('user.orders') }}" 
                       class="w-full py-3 rounded-full border border-gray-300 text-gray-700 font-poppins font-medium hover:bg-gray-50 transition text-center text-sm">
                        View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>