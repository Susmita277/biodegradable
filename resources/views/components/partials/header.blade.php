<div class="px-12 sticky top-0 bg-[#fbf8ef] z-60 hidden lg:block">
    <ul class="flex justify-between items-center py-2 ">
        <li>
            <a href="{{ route('home') }}">
                <div class="w-22 h-14 2xl:w-28 2xl:h-22 overflow-hidden">
                    <img src="https://imgs.search.brave.com/Jafg16FAnHcy46kLYXckN6GQzfrpvnE1lFAPbnMjSXM/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90aHVt/YnMuZHJlYW1zdGlt/ZS5jb20vYi93ZWIt/MTg2NDIyOTY4Lmpw/Zw" class="w-full h-full object- contain object-center">
                </div>
            </a>
        </li>
        <li class="flex items-center font-inter text-xs gap-8  justify-center ml-20">
            <a href="{{ route('home') }}">
                <p class="hover:text-[#389537]">Home</p>
            </a>
    
            <a href="{{ route('why-us') }}">
                <p class="hover:text-[#389537]">Why Us</p>
            </a>
            <a href="">
                <p class="hover:text-[#389537]">Our Products</p>
            </a>
            <a href="{{ route('contact') }}">
                <p class="hover:text-[#389537]">Contact</p>
            </a>
        </li>
        <li class="flex gap-2  justify-center">
           <a href="{{ route('home')}}#explore" class="smooth transition-all"> <button class="btn secondary">Explore</button></a>
          <a href="{{ route('contact')}}">  <button class="btn highlight">Get a Quote</button></a>
        </li>
    </ul>
</div>

<!-- Small Screen Header -->
<div class="lg:hidden  px-5 py-2 sticky top-0 bg-[#fbf8ef] z-60" x-data="{ open: false }">
    <div class="flex items-center justify-between w-full">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="transform -translate-x-10">
            <div class="w-24 h-12  overflow-hidden">
                <img src="{{ asset('abi.png') }}" class="w-full h-full object-contain ">
            </div>
        </a>
        <!-- Menu Icon -->
        <button @click="open = !open" class="text-gray-800 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


    </div>

    <!-- Dropdown Menu -->
    <div x-show="open" x-transition
        class="absolute top-full left-0 w-full bg-white  mt-2 rounded-b-lg bottom-0 h-screen">
        <ul class="flex flex-col gap-4 p-4 font-inter text-sm">
            <li><a href="{{ route('home') }}" class="block hover:text-[#389537]">Home</a></li>
            <li><a href="{{ route('about') }}" class="block hover:text-[#389537]">About Us</a></li>
            <li><a href="{{ route('why-us') }}" class="block hover:text-[#389537]">Why Us</a></li>
            <li><a href="{{ route('contact') }}" class="block hover:text-[#389537]">Contact</a></li>
        </ul>
    </div>
</div>