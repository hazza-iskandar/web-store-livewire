<div class="sticky top-0 z-[9999] w-full">
    <nav class="bg-white border-b-2 border-gray-400">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse order-1">
                <img src="{{ asset('assets/images/myLogo.png') }}" class="size-10 md:size-14 me-1 md:me-2"
                    alt="Logo" />
                <span
                    class="font-heading self-center text-lg md:text-2xl font-semibold whitespace-nowrap">{{ config('app.name') }}</span>
            </a>


            <div class="hidden w-full md:block md:w-auto order-3 md:order-2" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <x-navlink :active="request()->routeIs('home')" :href="route('home')">Home</x-navlink>
                    <x-navlink :active="request()->routeIs('products.*')" :href="route('products.index')">Products</x-navlink>
                    {{-- <x-navlink :active="request()->routeIs('about')" :href="route('about')">Categories</x-navlink>
                <x-navlink :active="request()->routeIs('contact')" :href="route('contact')">Categories</x-navlink> --}}
                    @guest
                        <x-navlink :active="request()->routeIs('register')" :href="route('register')">Sign-Up</x-navlink>
                    @endauth
                </ul>
            </div>

            {{-- menu list --}}
            <div class="flex items-center justify-end gap-2 md:w-auto order-2 md:order-3" id="navbar-default">
                <div class="hidden md:block w-1/2 md:w-full">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative sm:w-50 lg:w-full">
                        <div
                            class="relative cursor-pointer md:absolute inset-y-0 start-0 flex items-center ps-3 md:pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search" wire:model.live="search"
                            class="hidden md:block w-full p-3 ps-10 text-sm focus:outline-none text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                            placeholder="Search Products..." wire:model="search" required />
                        {{-- fungsi ini akan deteksi apkah aakan ada string kecuali spasi(trim )maka true jika tidak ada maka false --}}
                        @if (strlen(trim($search)) > 0)
                            {{-- strlen adalah fungsi php yg mendteksi string length return true or false --}}

                            {{-- iconi x close --}}
                            <div class="relative cursor-pointer md:absolute inset-y-0 end-2 flex items-center ps-3"
                                wire:click="resetSearch">
                                <i class="fa-solid fa-xmark text-gray-500"></i>
                            </div>

                            <div
                                class="w-full mt-2 rounded-md shadow-sm h-full min-h-30  overflow-y-scroll absolute bg-white">
                                @forelse ($products as $product)
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="inline-block w-full truncate text-xs md:text-sm mt-1 p-2 shadow-sm hover:bg-gray-200">
                                        <h3 class="font-semibold text-slate-800">
                                            {{ Str::words($product->title, 3, '...') }}
                                        </h3>
                                        <p class="text-[9px] md:text-xs font-normal text-primary">
                                            {{ $product->category->title }}</p>
                                    </a>
                                @empty
                                    <p class="text-center font-semibold text-sm mt-2 text-slate-400">Tidak ada
                                        Product</p>
                                @endforelse
                            </div>
                        @endif
                    </div>
                </div>
                {{-- keranjang --}}
                <a href="{{ route('cart') }}" class="text-xl" wire:navigate>
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                @auth
                    {{-- user --}}
                    <div id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="aspect-square p-[6px] bg-primary cursor-pointer grid place-items-center rounded-full">
                        <i class="fa-regular fa-user text-xl text-white"></i>
                    </div>
                    <!-- Dropdown menu User-->
                    <div id="dropdownInformation"
                        class="z-10 hidden bg-[#00000058] divide-y divide-gray-100 backdrop-blur-3xl rounded-lg shadow-sm w-44">
                        <div class="px-4 py-3 text-sm text-gray-100">
                            <div>{{ auth()->user()->username ?? '' }}</div>
                            <div class="font-medium truncate">{{ auth()->user()->email ?? '' }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-100" aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="{{ route('dashboard.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 hover:text-slate-800"
                                    wire:navigate>Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('account.profile') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 hover:text-slate-800" wire:navigate>Account</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <button wire:click="logout"
                                class="w-full text-start px-4 py-2 text-sm text-gray-100 hover:bg-gray-100 hover:text-slate-800">Log
                                Out</button>
                        </div>
                    </div>
                @endauth
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex cursor-pointer items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 hover:text-slate-800 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

</div>
