<div class="px-12 sticky top-0 bg-[#fbf8ef] z-60 hidden lg:block">
    <ul class="flex justify-between items-center py-2">
        <li>
            <a href="{{ route('home') }}">
                <div class="w-22 h-14 2xl:w-28 2xl:h-22 overflow-hidden">
                    <img src="https://imgs.search.brave.com/Jafg16FAnHcy46kLYXckN6GQzfrpvnE1lFAPbnMjSXM/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90aHVt/YnMuZHJlYW1zdGlt/ZS5jb20vYi93ZWIt/MTg2NDIyOTY4Lmpw/Zw" class="w-full h-full object-contain object-center" alt="Logo">
                </div>
            </a>
        </li>
        <li class="flex items-center font-inter text-xs gap-8 justify-center ml-20">
            <a href="{{ route('home') }}">
                <p class="hover:text-[#389537]">Home</p>
            </a>
            <a href="{{ route('why-us') }}">
                <p class="hover:text-[#389537]">Why Us</p>
            </a>
            <a href="{{ route('products') }}">
                <p class="hover:text-[#389537]">Our Products</p>
            </a>
            <a href="{{ route('contact') }}">
                <p class="hover:text-[#389537]">Contact</p>
            </a>
        </li>
        <li class="flex gap-2 justify-center items-center">
            <a href="{{ route('cart') }}" class="smooth transition-all relative">
                <livewire:cart-count />
            </a>

                    
            @auth
                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="w-10 h-10 rounded-full bg-[#389436] text-white flex items-center justify-center font-poppins font-bold text-sm hover:bg-[#2d7a2b] transition focus:outline-none">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </button>
                    
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-2xl border border-gray-200 shadow-xl py-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="font-inter font-medium text-sm text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="font-inter text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <!-- ✅ Profile link with tab parameter -->
                        <a href="{{ route('user.profile', ['tab' => 'profile']) }}" 
                           class="block px-4 py-2.5 font-inter text-sm text-gray-700 hover:bg-gray-50 hover:text-[#389436] transition">
                            👤 My Profile
                        </a>
                        <!-- ✅ Order History link with tab parameter -->
                        <a href="{{ route('user.orders', ['tab' => 'orders']) }}" 
                           class="block px-4 py-2.5 font-inter text-sm text-gray-700 hover:bg-gray-50 hover:text-[#389436] transition">
                            📦 Order History
                        </a>
                        <hr class="border-gray-100 my-1">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-4 py-2.5 font-inter text-sm text-red-600 hover:bg-red-50 transition">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}">
                    <button class="btn highlight">Sign In</button>
                </a>
            @endauth
        </li>
            
                   </ul>
</div>

<!-- Small Screen Header -->
<div class="lg:hidden px-5 py-2 sticky top-0 bg-[#fbf8ef] z-60" x-data="{ open: false }">
    <div class="flex items-center justify-between w-full">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="transform -translate-x-10">
            <div class="w-24 h-12 overflow-hidden">
                <img src="{{ asset('abi.png') }}" class="w-full h-full object-contain" alt="Logo">
            </div>
        </a>
        
        <div class="flex items-center gap-3">
            <!-- Cart Icon -->
            <a href="{{ route('cart') }}" class="relative">
                <livewire:cart-count />
            </a>
            
            @auth
                <!-- Mobile User Avatar -->
                <a href="{{ route('user.profile') }}" 
                   class="w-8 h-8 rounded-full bg-[#389436] text-white flex items-center justify-center font-poppins font-bold text-xs hover:bg-[#2d7a2b] transition">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-inter text-[#389436] hover:underline">Login</a>
            @endauth
            
            <!-- Menu Icon -->
            <button @click="open = !open" class="text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Dropdown Menu -->
    <div x-show="open" x-transition
         class="absolute top-full left-0 w-full bg-white mt-2 rounded-b-lg shadow-lg z-50">
        <ul class="flex flex-col gap-4 p-6 font-inter text-sm">
            <li><a href="{{ route('home') }}" class="block hover:text-[#389436] transition">Home</a></li>
            <li><a href="{{ route('about') }}" class="block hover:text-[#389436] transition">About Us</a></li>
            <li><a href="{{ route('why-us') }}" class="block hover:text-[#389436] transition">Why Us</a></li>
            <li><a href="{{ route('products') }}" class="block hover:text-[#389436] transition">Our Products</a></li>
            <li><a href="{{ route('contact') }}" class="block hover:text-[#389436] transition">Contact</a></li>
            
            @auth
                <hr class="border-gray-200">
                <li><a href="{{ route('user.profile') }}" class="block hover:text-[#389436] transition">👤 My Profile</a></li>
                <li><a href="{{ route('user.orders') }}" class="block hover:text-[#389436] transition">📦 Order History</a></li>
                <li>
                    <!-- ✅ Logout Form for Mobile -->
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="block w-full text-left text-red-600 hover:text-red-800 transition">
                            🚪 Logout
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="block text-[#389436] font-medium hover:underline">Sign In</a></li>
                <li><a href="{{ route('register') }}" class="block text-[#389436] font-medium hover:underline">Register</a></li>
            @endauth
        </ul>
    </div>
</div>
