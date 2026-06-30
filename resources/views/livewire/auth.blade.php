<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

        {{-- Logo / Brand --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-[#389436] mb-3">
            </div>
            <h1 class="font-poppins font-medium text-2xl text-gray-900">Welcome back</h1>
            <p class="font-poppins text-sm text-gray-500 mt-1">Log in to continue shopping eco-friendly</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-3xl p-8 border border-gray-200">
            <form action="#" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block font-poppins text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" placeholder="you@example.com"
                        class="w-full rounded-xl border-gray-300 font-poppins text-sm py-2.5 px-4 focus:border-[#389436] focus:ring-[#389436]">
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block font-poppins text-sm font-medium text-gray-700">Password</label>
                    </div>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full rounded-xl border-gray-300 font-poppins text-sm py-2.5 px-4 focus:border-[#389436] focus:ring-[#389436]">
                </div>

                {{-- forgot  password --}}
                <div class="flex items-center gap-2">
                        <a href="#" class="font-poppins text-xs text-[#389436] hover:underline">Forgot password?</a>

              
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-[#389436] hover:bg-[#2d7a2b] text-white font-poppins font-medium text-sm py-3 rounded-full transition">
                    Log in
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="font-poppins text-xs text-gray-400">or</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

          
       

        {{-- Toggle to Register --}}
        <p class="text-center font-poppins text-sm text-gray-600 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#389436] font-medium hover:underline">Sign up</a>
        </p>
    </div>
     </div>
</div>