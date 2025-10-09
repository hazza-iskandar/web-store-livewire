<div>
    <section class="my-4 flex">
        <div class="container">
            <div class="">
                <div class="mt-3 mb-5">
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary"
                                    wire:navigate>
                                    <i class="fa-solid fa-house me-2"></i>
                                    Home
                                </a>
                            </li>
                            <li class="inline-flex items-center">
                                <a href="{{ route('products') }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary"
                                    wire:navigate>
                                    <i class="fas fa-box me-2"></i>
                                    Products
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chevron-right text-sm text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Product</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="mt-10">
                <div class="flex sm:flex-row flex-col">
                    <div class="w-full sm:w-1/2 mb-5">
                        <div class="swiper showProduct">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                        class="h-100 rounded-md" alt="" loading="lazy">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                        class="h-100 rounded-md" alt="" loading="lazy">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                        class="h-100 rounded-md" alt="" loading="lazy">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                        class="h-100 rounded-md" alt="" loading="lazy">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="w-full sm:w-1/2 sm:ms-8 ">
                        <div class="pb-4 border-b-3 border-slate-600">
                            <h1 class="font-heading text-2xl sm:text-3xl mb-1">Game Pad</h1>
                            <span class="sm:text-[16px] text-sm me-4">categorty</span>
                            <span
                                class="bg-green-100 text-green-800 text-xs sm:text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm">Stok
                                tersedia 80</span>

                            <p class="mt-2 text-primary text-xl sm:text-2xl"><span class="text-[16px]">Rp.</span>
                                3.000.000</p>
                            <p class="text-slate-700 mt-2 sm:mt-4 sm:text-[16px] text-sm">Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit.
                                Ducimus ad ea, maxime nemo possimus veniam nesciunt ullam suscipit culpa doloribus!</p>
                        </div>

                        <div class="mt-5">
                            <div class="flex items-center">
                                <!-- Tombol Minus -->
                                <button type="button" id="minusBtn"
                                    class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>

                                <!-- Input Jumlah -->
                                <input type="number" id="quantityInput" min="0" value="1"
                                    class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block text-center px-2.5 py-1"
                                    readonly />

                                <!-- Tombol Plus -->
                                <button type="button" id="plusBtn"
                                    class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>

                            <a href="" type="button"
                                class="text-white inline-block mt-3 w-full bg-primary hover:bg-primary focus:outline-none text-sm sm:text-lg focus:ring-4 focus:ring-blue-300 font-medium rounded-sm px-3 py-1.5 sm:px-5 sm:py-2.5 text-center me-2 mb-2">Beli</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="heading-title mt-15">
                <h3 class="">Related Products</h3>
                <div class="flex justify-between items-center">
                    <p class="text-heading font-bold mt-3 text-2xl">Produk Terkait</p>

                    <div class="flex gap-2">
                        <div
                            class="button-prev w-10 h-10 bg-secondary hover:bg-slate-700 hover:text-white cursor-pointer transition-all flex justify-center items-center rounded-full">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div
                            class="button-next w-10 h-10 bg-secondary hover:bg-slate-700 hover:text-white cursor-pointer transition-all flex justify-center items-center rounded-full">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div class="swiper newProduct">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="" class="max-w-sm bg-white rounded-lg">
                                <div class="relative group overflow-hidden">
                                    <img class="rounded-t-lg"
                                        src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                        alt="" loading="lazy" />

                                    <span
                                        class="absolute top-4 bg-primary text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-r-md ">Baru</span>

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
                                    <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900">Game
                                        Pad
                                    </h5>
                                    <p class="text-primary text-sm">Rp. 3.000.000</p>
                                    <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">Lorem ipsum dolor sit
                                        amet,
                                        consectetur
                                        adipisicing elit. Explicabo, dolor!</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const minusBtn = document.getElementById('minusBtn');
        const plusBtn = document.getElementById('plusBtn');
        const input = document.getElementById('quantityInput');

        minusBtn.addEventListener('click', () => {
            let value = parseInt(input.value) || 0;
            if (value > 0) input.value = value - 1;
        });

        plusBtn.addEventListener('click', () => {
            let value = parseInt(input.value) || 0;
            // max data 10 
            if (value < 10) input.value = value + 1;
        });
    </script>
</div>
