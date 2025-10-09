<div>
    <section class="my-4 flex">
        <div class="container">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mt-3 mb-5">
                    <h1 class="text-3xl font-semibold font-heading">Products</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary" wire:navigate>
                                    <i class="fa-solid fa-house me-2"></i>
                                    Home
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chevron-right text-sm text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Products</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="mt-3 md:w-100 w-full">
                    <form class="max-w-lg mx-auto">
                        <div class="flex">
                            <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                                type="button">Categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>
                            <div id="dropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button">
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Mockups</button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Templates</button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Design</button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Logos</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="relative w-full">
                                <input type="search" id="search-dropdown"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-primary outline-none focus:border-primary"
                                    placeholder="Cari Product" required />
                                <button type="submit"
                                    class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-7">
                <div class="mt-1 sm:mt-3">
                    <a href="{{ route('product.show') }}" class="max-w-sm bg-white rounded-lg" wire:navigate>
                        <div class="relative group overflow-hidden">
                            <span
                                    class="absolute top-4 bg-primary text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-r-md ">Baru</span>
                                    
                            <img class="rounded-t-lg"
                                src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                                loading="lazy" />
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="">
                                <button
                                    class="absolute z-10 transition-all duration-500 group-hover:bottom-0 group-hover:opacity-100 opacity-0 -bottom-10 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
                                    Tambah Ke Keranjang
                                </button>
                            </form>
                        </div>
                        <div class="pt-2">
                            <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900">Game Pad
                            </h5>
                            <p class="text-primary text-sm">Rp. 3.000.000</p>
                            <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit. Explicabo, dolor!</p>
                        </div>
                    </a>
                </div>
                <div class="mt-1 sm:mt-3">
                    <a href="" class="max-w-sm bg-white rounded-lg">
                        <div class="relative group overflow-hidden">
                            <img class="rounded-t-lg"
                                src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                                loading="lazy" />
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="">
                                <button
                                    class="absolute z-10 transition-all duration-500 group-hover:bottom-0 group-hover:opacity-100 opacity-0 -bottom-10 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
                                    Tambah Ke Keranjang
                                </button>
                            </form>
                        </div>
                        <div class="pt-2">
                            <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900">Game Pad
                            </h5>
                            <p class="text-primary text-sm">Rp. 3.000.000</p>
                            <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit. Explicabo, dolor!</p>
                        </div>
                    </a>
                </div>
                <div class="mt-1 sm:mt-3">
                    <a href="" class="max-w-sm bg-white rounded-lg">
                        <div class="relative group overflow-hidden">
                            <img class="rounded-t-lg"
                                src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                                loading="lazy" />
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="">
                                <button
                                    class="absolute z-10 transition-all duration-500 group-hover:bottom-0 group-hover:opacity-100 opacity-0 -bottom-10 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
                                    Tambah Ke Keranjang
                                </button>
                            </form>
                        </div>
                        <div class="pt-2">
                            <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900">Game Pad
                            </h5>
                            <p class="text-primary text-sm">Rp. 3.000.000</p>
                            <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit. Explicabo, dolor!</p>
                        </div>
                    </a>
                </div>
                <div class="mt-1 sm:mt-3">
                    <a href="" class="max-w-sm bg-white rounded-lg">
                        <div class="relative group overflow-hidden">
                            <img class="rounded-t-lg"
                                src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                                loading="lazy" />
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="">
                                <button
                                    class="absolute z-10 transition-all duration-500 group-hover:bottom-0 group-hover:opacity-100 opacity-0 -bottom-10 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
                                    Tambah Ke Keranjang
                                </button>
                            </form>
                        </div>
                        <div class="pt-2">
                            <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900">Game Pad
                            </h5>
                            <p class="text-primary text-sm">Rp. 3.000.000</p>
                            <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit. Explicabo, dolor!</p>
                        </div>
                    </a>
                </div>
                <div class="mt-1 sm:mt-3">
                    <a href="" class="max-w-sm bg-white rounded-lg">
                        <div class="relative group overflow-hidden">
                            <img class="rounded-t-lg"
                                src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                                loading="lazy" />
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="">
                                <button
                                    class="absolute z-10 transition-all duration-500 group-hover:bottom-0 group-hover:opacity-100 opacity-0 -bottom-10 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
                                    Tambah Ke Keranjang
                                </button>
                            </form>
                        </div>
                        <div class="pt-2">
                            <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900">Game Pad
                            </h5>
                            <p class="text-primary text-sm">Rp. 3.000.000</p>
                            <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit. Explicabo, dolor!</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="flex flex-col items-center mt-10">
                <!-- Help text -->
                <span class="text-sm text-gray-700 ">
                    Showing <span class="font-semibold text-gray-900">1</span> to <span
                        class="font-semibold text-gray-900">10</span> of <span
                        class="font-semibold text-gray-900">100</span> Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button
                        class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 cursor-pointer ">
                        Prev
                    </button>
                    <button
                        class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 cursor-pointer ">
                        Next
                    </button>
                </div>
            </div>

        </div>
    </section>
</div>
