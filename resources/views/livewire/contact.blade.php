<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    {{-- I'm rollin' up my broccoli, LFG 🥦 --}}
    <x-seo :seo="$seo" />
    <x-page-blocks :blocks="$blocks" />

    @if ($successMessage)
        <div class="bg-green-100 text-green-700 p-2 rounded-md w-fit lg:pl-12 px-5 ">{{ $successMessage }}</div>
    @endif
    <div class="lg:py-12 lg:px-40 2xl:px-50 p-5 grid lg:grid-cols-3 grid-cols-1  gap-10" id="form">
        <div class="p-12 border-2 border-dashed border-gray-200 lg:col-span-2 min-h-[400px]  max-h-auto">
            <h3>Contact us</h3>
            <span>Got any questions or suggestions? Fill out this form to reach out.</span>
            <form wire:submit.prevent="send">
                <div class="my-4 grid lg:grid-cols-2 grid-cols-1 lg:gap-10 gap-y-10 2xl:my-12">
                    <div>
                        <input placeholder="Enter your name " type="text"
                            class="outline-none  border-b-2 border-gray-200 pb-2 pointer-cursor w-full" wire:model="name">
                        @error('name')
                            <span class="text-sm/8 2xl:text-xl/8 text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input placeholder="Enter your email " type="email"
                            class="outline-none  border-b-2 border-gray-200 pb-2 pointer-cursor w-full"
                            wire:model="email">
                        @error('email')
                            <span class="text-sm/8 text-red-500 mt-2 2xl:text-xl/8">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="lg:col-span-2">
                        <input placeholder="Enter your message " type="text"
                            class="outline-none  border-b-2 border-gray-200 pb-6 pointer-cursor w-full min-h-10 max-h-10 "
                            wire:model="message">
                        @error('message')
                            <span class="text-sm/8 text-red-500 mt-2 2xl:text-xl/8">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button class="flex gap-2 btn main !h-8 2xl:!h-10 w-fit mt-8 " type="submit">
                    <p>Send Us</p>
                    <x-heroicon-s-arrow-trending-up class="w-5 h-5" />
                </button>
            </form>

            <div class=" flex text-gray-500 items-center py-2 gap-1 flex-wrap"><span>You can email us directly at
                </span>
                <a href="#" class="underline text-sm/8 2xl:text-xl/8 font-medium">abibiodegredeable@gmail.com</a>
            </div>
        </div>
        <div class="h-[400px] overflow-hidden ">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57068.60930155858!2d87.94697964597012!3d26.62323869838304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e5baf5bbac5971%3A0xf4e38a45f65be2e7!2sBirtamod!5e0!3m2!1sen!2snp!4v1761635205622!5m2!1sen!2snp"
                referrerpolicy="no-referrer-when-downgrade" class="h-full w-full object-cover  "></iframe>
        </div>
    </div>
</div>
