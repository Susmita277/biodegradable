<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white rounded-3xl p-8 border border-gray-200">
        <h1 class="font-poppins font-medium text-xl text-center mb-1">Create Account</h1>
        <p class="font-poppins text-sm text-gray-500 text-center mb-6">Join us in reducing plastic waste</p>

        <form wire:submit="register" class="space-y-4">
            <div>
                <label class="font-poppins text-sm text-gray-700 mb-1 block">Full Name</label>
                <input type="text" wire:model="name" placeholder="Your name"
                    class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                @error('name') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="font-poppins text-sm text-gray-700 mb-1 block">Email</label>
                <input type="email" wire:model="email" placeholder="you@example.com"
                    class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                @error('email') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="font-poppins text-sm text-gray-700 mb-1 block">Password</label>
                <input type="password" wire:model="password" placeholder="At least 8 characters"
                    class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
                @error('password') <span class="text-red-500 text-xs font-poppins mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="font-poppins text-sm text-gray-700 mb-1 block">Confirm Password</label>
                <input type="password" wire:model="password_confirmation" placeholder="••••••••"
                    class="w-full rounded-lg border-gray-300 text-sm font-poppins focus:border-[#389436] focus:ring-[#389436]">
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full py-3 rounded-full bg-[#389436] text-white font-poppins font-medium hover:bg-[#2d7a2b] transition disabled:opacity-60">
                <span wire:loading.remove wire:target="register">Create Account</span>
                <span wire:loading wire:target="register">Creating account...</span>
            </button>
        </form>

        <p class="font-poppins text-sm text-gray-500 text-center mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#389436] font-medium hover:underline">Log In</a>
        </p>
    </div>
</div>