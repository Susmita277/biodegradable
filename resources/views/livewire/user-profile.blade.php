
<div class="max-w-6xl mx-auto px-4 py-8">
    @if(session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 font-inter text-sm">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('password_message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 font-inter text-sm">
            {{ session('password_message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-6 border border-gray-200 sticky top-6 text-center">
                <!-- Avatar with Initials -->
                <div class="w-24 h-24 rounded-full bg-[#389436] text-white flex items-center justify-center mx-auto text-3xl font-poppins font-bold">
                    {{ $this->initials }}
                </div>
                
                <h3 class="font-poppins font-medium text-lg mt-4">{{ $user->name }}</h3>
                <p class="font-poppins text-sm text-gray-500">{{ $user->email }}</p>
                
                <hr class="border-gray-200 my-4">
                
                <nav class="space-y-2 text-left">
                    <!-- ✅ Direct link to Orders -->
                    <a href="{{ route('user.orders') }}" 
                       class="w-full text-left px-4 py-2 rounded-lg font-inter text-sm transition block
                       {{ $activeTab === 'orders' ? 'bg-[#389436] text-white' : 'hover:bg-gray-100 hover:text-[#389436]' }}">
                        📦 My Orders
                    </a>
                    
                    <!-- ✅ Direct link to Profile -->
                    <a href="{{ route('user.profile') }}" 
                       class="w-full text-left px-4 py-2 rounded-lg font-inter text-sm transition block
                       {{ $activeTab === 'profile' ? 'bg-[#389436] text-white' : 'hover:bg-gray-100 hover:text-[#389436]' }}">
                        👤 Profile Settings
                    </a>
                    
                  
                        <form method="POST" action="{{ route('logout') }}" class="block w-full">
                        @csrf
                        <button type="submit" 
                                class="w-full text-left px-4 py-2 rounded-lg font-inter text-sm text-red-600 hover:bg-red-50 transition">
                            🚪 Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            @if($activeTab === 'orders')
                <!-- Orders Tab Content -->
                <div class="bg-white rounded-3xl p-6 border border-gray-200">
                    <h2 class="font-poppins font-medium text-xl mb-6">My Orders</h2>
                    
                    @if($orders->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📦</div>
                            <p class="font-poppins text-gray-500 mb-4">No orders yet</p>
                            <a href="{{ route('products') }}" class="inline-block px-6 py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition">
                                Start Shopping
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 rounded-2xl p-4 hover:shadow-md transition">
                                    <div class="flex flex-wrap items-start justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 flex-wrap">
                                                <span class="font-poppins font-medium">Order #{{ $order->id }}</span>
                                                <span class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y g:i A') }}</span>
                                                <span class="px-3 py-1 rounded-full text-xs font-poppins font-medium
                                                    @if($order->status === 'delivered') bg-green-100 text-green-800
                                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800
                                                    @elseif($order->status === 'processing') bg-yellow-100 text-yellow-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                            <p class="font-inter text-sm text-gray-500 mt-1">
                                                {{ $order->items->count() }} items • {{ $order->district->name ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <span class="font-poppins font-bold text-[#389436]">NPR.{{ number_format($order->total, 0) }}</span>
                                            <a href="{{ route('orders.show', $order) }}" 
                                               class="px-4 py-2 rounded-full border border-[#389436] text-[#389436] font-inter text-sm hover:bg-[#389436] hover:text-white transition">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <!-- Profile Settings Tab Content -->
                <div class="bg-white rounded-3xl p-6 border border-gray-200">
                    <h2 class="font-poppins font-medium text-xl mb-6">Profile Settings</h2>
                    
                    <!-- Name and Email (Read-only display) -->
                    <div class="bg-gray-50 rounded-2xl p-4 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-inter text-xs text-gray-500 block">Full Name</label>
                                <p class="font-poppins font-medium text-gray-800">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="font-inter text-xs text-gray-500 block">Email Address</label>
                                <p class="font-poppins font-medium text-gray-800">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Form -->
                    <div>
                        <h3 class="font-poppins font-medium text-lg mb-4 text-[#389436]">Change Password</h3>
                        <form wire:submit.prevent="changePassword" class="space-y-4">
                            <div>
                                <label class="font-inter text-sm text-gray-700 block mb-1">Current Password</label>
                                <input type="password" wire:model="current_password" 
                                       class="w-full rounded-lg border-gray-300 text-sm font-inter focus:border-[#389436] focus:ring-[#389436]"
                                       placeholder="Enter current password">
                                @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="font-inter text-sm text-gray-700 block mb-1">New Password</label>
                                <input type="password" wire:model="new_password" 
                                       class="w-full rounded-lg border-gray-300 text-sm font-inter focus:border-[#389436] focus:ring-[#389436]"
                                       placeholder="Enter new password (min 6 characters)">
                                @error('new_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="font-inter text-sm text-gray-700 block mb-1">Confirm New Password</label>
                                <input type="password" wire:model="new_password_confirmation" 
                                       class="w-full rounded-lg border-gray-300 text-sm font-inter focus:border-[#389436] focus:ring-[#389436]"
                                       placeholder="Confirm new password">
                            </div>

                            <button type="submit" 
                                    class="px-6 py-3 rounded-full bg-[#389436] text-white font-inter font-medium hover:bg-[#2d7a2b] transition">
                                Change Password
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
