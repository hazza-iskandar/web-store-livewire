<div>
    <x-notifAlert />
    <div class="my-9 flex h-screen">
        <div class="hidden md:block md:w-1/2 lg:w-3/5 bg-[#CBE4E8] h-full">
            <img src="{{ asset('assets/images/signImg.png') }}" alt="" class="w-full h-full object-cover">
        </div>


        <div class="w-full md:w-1/2 lg:w-2/5 h-full p-10 md:p-15 ld:p-20 md:px-18 lg:px-24">
            <h2 class="text-3xl text-center font-normal font-heading">Sign In</h2>
            <form class="max-w-md mt-10 mx-auto mb-7" wire:submit="autenticate">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" id="email" wire:model="email" wire:focus="resetField('email')"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary peer"
                        placeholder=" " required />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                    @error('email')
                        <p id="standard_error_help" class="mb-3 mt-1 text-xs text-red-600"><span
                                class="font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-4 group">
                    <input type="password" id="floating_password" wire:model="password" wire:focus="resetField('password')"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary peer"
                        placeholder=" " required />
                    <label for="floating_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    @error('password')
                        <p id="standard_error_help" class="mb-3 mt-1 text-xs text-red-600"><span
                                class="font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center">
                    <input id="checkbox-1" type="checkbox" wire:model="remember"
                        class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded-sm focus:ring-primary focus:ring-2 ">
                    <label for="checkbox-1" class="ms-2 text-sm font-medium text-gray-400">Ingat Saya</label>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="text-white bg-primary hover:bg-[#980e0e] focus:ring-4 mt-6 focus:outline-none focus:ring-primary font-medium rounded-sm text-[16px] w-full flex justify-center gap-2 px-5 py-3.5 text-center cursor-pointer">
                    <span wire:loading.class="bg-[#980e0e]">Buat Akun</span>


                    <div role="status" wire:loading wire:target="autenticate">
                        <i class="fa-solid fa-spinner text-gray-200 animate-spin"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>

                {{-- <a href=""
                    class="border-2 border-gray-400 mt-3 w-full px-5 py-3.5 text-center text-slate-800 font-medium rounded-sm text-[16px] flex items-center justify-center gap-2 hover:bg-slate-800 hover:text-white transition-all duration-500">
                    <img src="{{ asset('assets/images/logoGoogle.png') }}" alt="Google" class="w-5 h-5"> Masuk
                    Dengan
                    Google
                </a> --}}
            </form>
            {{-- <p class="text-gray-500 font-normal text-center mt-4">Lupa Password? <a href="" class="ms-3 font-semibold hover:text-primary transition-all">Lupa Password</a></p> --}}

            <p class="text-gray-500 font-normal text-center mt-2">Belum punya akun? <a href="{{ route('register') }}"
                    class="ms-3 font-semibold hover:text-primary transition-all" wire:navigate>Sign Up</a></p>

        </div>
    </div>
</div>
