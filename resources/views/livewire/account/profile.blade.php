<div>
    <x-notifAlert/>
    <section class="my-4 flex">
        <div class="container">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                <div class="mt-3 mb-5">
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}" wire:navigate
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary"
                                    wire:navigate>
                                    <i class="fa-solid fa-house me-2"></i>
                                    Home
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chevron-right text-sm text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Account</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <p class="text-xl mt-2sm:mt-0 sm:text-sm">Welcome! <span
                        class="text-primary font-semibold">{{ auth()->user()->username ?? '' }}</span></p>
            </div>

            <div class="flex flex-col lg:flex-row justify-between gap-10 mt-3 sm:mt-10">
                <div class="w-full lg:w-1/5">
                    <h3 class="font-semibold hidden sm:block">Manage My Account</h3>
                    <h3 class="font-semibold sm:hidden block mt-4">My Account</h3>
                    <ul
                        class="ms-0 sm:ms-7 sm:mt-2 flex gap-3 w-full overflow-scroll scrollbar-hide py-3 sm:p-0 sm:block">
                        <li class="text-slate-600 text-sm my-1">
                            <a href="{{ route('account.profile') }}" wire:navigate
                                class="hover:text-primary {{ request()->routeIs('account.profile') ? 'text-primary' : '' }}">
                                Profile
                            </a>
                        </li>
                        <li class="text-slate-600 text-sm my-1">
                            <a href="" class="hover:text-primary">
                                Pesanan
                            </a>
                        </li>
                        {{-- <li class="text-slate-600 text-sm my-1"><a href="" class="hover:text-primary">
                                    My Profile
                                </a></li> --}}
                    </ul>
                </div>

                <div class="w-full lg:w-4/5">
                    <div class="lg:shadow-lg rounded-md w-full lg:px-20 sm:py-13">
                        <h1 class="text-xl md:text-2xl text-primary font-semibold mb-3">Edit Profile</h1>

                        <div class="flex flex-col lg:flex-row gap-10">

                            {{-- left img profile --}}
                            <div class="w-full lg:w-1/4">
                                <form class="flex flex-col items-center space-y-4">
                                    <!-- Foto Profil -->
                                    <div class="relative w-full flex justify-center items-center">
                                        <!-- Foto Profil -->
                                        <div class="relative">
                                            <img id="profilePreview" src="" alt=""
                                                class="w-36 h-36 md:w-45 md:h-45 lg:w-40 lg:h-40 rounded-full object-cover border-4 border-slate-600 bg-primary cursor-pointer transition hover:opacity-80" />
                                            <input id="profileInput" type="file" accept="image/*" class="hidden" />

                                            <!-- Icon Ubah -->
                                            <label for="profileInput"
                                                class="absolute bottom-2 right-2 bg-primary text-white rounded-full p-2 cursor-pointer shadow hover:bg-primary/80">
                                                <i class="fas fa-camera text-sm"></i>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- right form profile --}}
                            <form class="w-full lg:w-3/4" wire:submit="saveProfile">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" id="username" wire:model="username"
                                            wire:focus='resetField("username")'
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer"
                                            placeholder=" " required />
                                        <label for="username"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                                        @error('username')
                                            <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                    class="font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" id="email" wire:model="email"
                                            wire:focus='resetField("email")'
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer"
                                            placeholder=" " required />
                                        <label for="email"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                                        @error('email')
                                            <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                    class="font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" id="fullname" wire:model="fullname"
                                            wire:focus='resetField("fullname")'
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer"
                                            placeholder=" " required />
                                        <label for="fullname"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                                            Lengkap</label>
                                        @error('fullname')
                                            <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                    class="font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="tel" wire:model="phone" id="phone"
                                            wire:focus='resetField("phone")'
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer"
                                            placeholder=" " required />
                                        <label for="phone"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nomor
                                            Telpon</label>
                                        @error('phone')
                                            <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                    class="font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <textarea id="address" rows="3" wire:model="adress" wire:focus='resetField("adress")'
                                        class="peer block w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary p-2.5 resize-none"
                                        placeholder=" " required></textarea>
                                    <label for="address"
                                        class="absolute text-sm text-gray-500 mt-3 duration-300 transform -translate-y-6 scale-75 top-2 origin-[0] peer-placeholder-shown:translate-y-2 peer-placeholder-shown:scale-100 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-primary">
                                        Alamat
                                    </label>
                                    @error('adress')
                                        <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                class="font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="password" id="password" wire:model="password"
                                        wire:focus='resetField("password")'
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer"
                                        placeholder=" " />
                                    <label for="password"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                    @error('password')
                                        <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                class="font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="password" id="new_password" wire:model="newPassword"
                                        wire:focus='resetField("newPassword")'
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary peer"
                                        placeholder=" " />
                                    <label for="new_password"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">New
                                        password</label>
                                    @error('newPassword')
                                        <p id="standard_error_help" class="my-1 text-xs text-red-600"><span
                                                class="font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" wire:loading.attr='disabled' wire:loading.class='bg-[#980e0e]'
                                    class="text-white bg-primary hover:bg-[#980e0e] focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">
                                    <span>Save Profile</span>

                                    <div role="status" wire:loading wire:target="saveProfile">
                                        <i class="fa-solid fa-spinner text-gray-200 animate-spin"></i>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
