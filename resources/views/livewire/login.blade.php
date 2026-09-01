<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white rounded-3xl p-8 border border-gray-200">
        <h1 class="font-poppins font-medium text-2xl text-center mb-1">Welcome Back</h1>
        <p class="font-poppins text-sm text-gray-500 text-center mb-6">Log in to continue shopping sustainably</p>

        <form wire:submit="login" class="space-y-4">
            <div>
                <label class="font-poppins text-sm text-gray-700 mb-1 block">Email</label>
                <input type="email" wire:model="email" placeholder="you@example.com"
                    class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                @error('email') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="font-poppins text-sm text-gray-700 mb-1 block">Password</label>
                <input type="password" wire:model="password" placeholder="••••••••"
                    class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                @error('password') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
            </div>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" wire:model="remember" class="w-4 h-4 rounded border-gray-300 text-[#389436] focus:ring-[#389436]">
                <span class="font-poppins text-sm text-gray-600">Remember me</span>
            </label>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition disabled:opacity-60">
                <span wire:loading.remove wire:target="login">Log In</span>
                <span wire:loading wire:target="login">Logging in...</span>
            </button>
        </form>

        <p class="font-poppins text-sm text-gray-500 text-center mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#389436] font-medium hover:underline">Register</a>
        </p>
    </div>
</div>