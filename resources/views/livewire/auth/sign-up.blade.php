<div>
    <div>
        <div class="my-9 flex h-screen">

            <div class="hidden md:block md:w-1/2 lg:w-3/5 bg-[#CBE4E8] h-full">
                <img src="{{ asset('assets/images/signImg.png') }}" alt="" class="w-full h-full object-cover">
            </div>


            <div class="w-full md:w-1/2 lg:w-2/5 h-full p-10 md:p-15 ld:p-20 md:px-18 lg:px-24">
                <h2 class="text-3xl text-center font-normal font-heading">Sign Up</h2>
                <form class="max-w-md mt-10 mx-auto">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="username" id="username"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary peer"
                            placeholder=" " required />
                        <label for="username"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="email" id="email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary peer"
                            placeholder=" " required />
                        <label for="email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                    </div>
                    <div class="relative z-0 w-full mb-8 group">
                        <input type="password" name="floating_password" id="floating_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-primary peer"
                            placeholder=" " required />
                        <label for="floating_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    <button type="submit"
                        class="text-white bg-primary hover:bg-[#980e0e] focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-sm text-[16px] w-full  px-5 py-3.5 text-center">Buat
                        Akun</button>
                    <a href=""
                        class="border-2 border-gray-400 mt-3 w-full px-5 py-3.5 text-center text-slate-800 font-medium rounded-sm text-[16px] flex items-center justify-center gap-2 hover:bg-slate-800 hover:text-white transition-all duration-500">
                        <img src="{{ asset('assets/images/logoGoogle.png') }}" alt="Google" class="w-5 h-5"> Daftar
                        Dengan Google
                    </a>

                    <p class="text-gray-500 font-normal text-center mt-4">Sudah punya akun? <a
                            href="{{ route('auth.signIn') }}"
                            class="ms-3 font-semibold hover:text-primary transition-all" wire:navigate>Sign In</a></p>
                </form>

            </div>
        </div>
    </div>

</div>
