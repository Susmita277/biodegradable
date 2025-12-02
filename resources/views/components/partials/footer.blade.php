<footer class="mx-12 py-4 mt-12 border-t border-gray-200/40 ">
    <ul class="lg:flex lg:justify-between grid  items-center pb-4">
        <li class="flex justify-center">
            <a href="{{ route('home') }}">
                <div class="w-18 h-12 2xl:h-20 2xl:w-24 overflow-hidden">
                    <img src="https://abi.on-forge.com/abi.png"
                        class="w-full h-full object- contain object-center">
                </div>
            </a>
        </li>
        <li class="mt-4 lg:mt-0">
            <ul class="flex gap-8 items-center  justify-center text-gray-500 leading-relaxed">
                <li>
                    <a href="#">
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>About</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>Contact</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span>Terms and Conditions</span>
                    </a>
                </li>
            </ul>

        </li>
        <li class="flex items-center gap-6 mt-4 lg:mt-0 justify-center">
            <a class="rounded-full  border border-gray-200 flex justify-center items-center w-8 h-8 2xl:w-12 2xl:h-12">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                    viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
            </a>
            <a class="rounded-full  border border-gray-200 flex justify-center items-center w-8 h-8 2xl:w-12 2xl:h-12">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                    viewBox="0 0 24 24">
                    <path
                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                    </path>
                </svg>
            </a>
            <a class="rounded-full  border border-gray-200 flex justify-center items-center w-8 h-8 2xl:w-12 2xl:h-12">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
            </a>
            <a class="rounded-full  border border-gray-200 flex justify-center items-center w-8 h-8 2xl:w-12 2xl:h-12">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                    <path stroke="none"
                        d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                    </path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
            </a>
        </li>
    </ul>
    <div class="mt-4 pt-4 border-t border-gray-200/40 flex justify-center items-center">
        <div class="flex gap-1 items-center"><span class="text-gray-500 ">Made with </span>
            <x-heroicon-c-heart class="w-5 h-5 text-[#389537]" />
            <span class="text-gray-500">by bytencoder</span>
        </div>
    </div>
</footer>