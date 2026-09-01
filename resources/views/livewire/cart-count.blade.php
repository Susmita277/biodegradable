<a href="{{ route('cart') }}" class="relative inline-flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition">
    <x-heroicon-o-shopping-bag class="w-6 h-6 text-gray-700" />

    @if ($count > 0)
        <span class="absolute -top-1 -right-1 flex items-center justify-center min-w-[18px] h-[18px] px-1 rounded-full bg-[#389436] text-white text-[10px] font-poppins font-medium">
            {{ $count }}
        </span>
    @endif
</a>