<div class="container">
    <div class="mt-2 w-full h-130 shadow-md">
        <div class="swiper jumbtron rounded-xl">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative">
                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                        loading="lazy">
                    <div class="absolute inset-0 bg-[#00000029] px-6 md:px-10 flex flex-col justify-end pb-10">

                        <div class="w-80 md:w-200 text-start line-clamp-3 mb-20 lg:mb-30">
                            <p class="font-bold text-sm md:text-lg ">category.</p>
                            <h3 class="font-bold text-2xl lg:text-4xl ">Lorem, ipsum Lorem, ipsum dolor Lorem
                                ipsum dolor sit
                                amet consectetur adipisicing elit. Voluptates</h3>
                        </div>
                        <a href=""
                            class="text-white text-center w-40 bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Lihat
                            Produk <i class="fa-solid fa-bag-shopping"></i></a>

                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    {{-- new product --}}
    <section class="section">
        <div class="heading-title">
            <h3 class="">New Products</h3>
            <div class="flex justify-between items-center">
                <p class="text-heading font-bold mt-3 text-2xl">Produk Terbaru Kami</p>

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
            </div>

            <div class="mt-8 q flex justify-center">
                <a href=""
                    class="text-white inline-block text-center w-60 bg-primary hover:bg-[#a22626] focus:ring-4 focus:ring-primary rounded-sm  md:text-[15px] text-sm  font-semibold px-3 py-1.5 md:px-5 md:py-2.5 focus:outline-none">Lihat
                    Semua Produk</a>
            </div>

        </div>
    </section>

    {{-- categori --}}
    <section class="section">
        <div class="heading-title">
            <h3 class="">Categories</h3>
            <div class="flex justify-between items-center">
                <p class="text-heading font-bold mt-3 text-2xl">Kategori Produk</p>

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
            <div class="swiper category">
                <div class="swiper-wrapper">
                    <div class="swiper-slide ">
                        <a href=""
                            class="inline-block w-full text-center border-2 border-slate-400 rounded-sm p-2 hover:border-primary hover:bg-primary hover:text-white transition-all">
                            <p>Phones</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- hightlight --}} {{-- Optional --}}
    <section class="section w-full h-full md:h-130 shadow-md bg-slate-800">
        <div class="flex flex-col md:flex-row h-full">
            <div class="absolute p-5">
                <h3
                    class="text-myGreen font-heading font-semibold flex items-center before:w-3 before:h-7 before:mr-3 before:rounded-sm before:bg-myGreen before:block">
                    featured product</h3>
                <p class="hidden md:block text-heading font-bold mt-2 text-xl text-white">Product Unggulan Kami</p>
            </div>

            <div class="p-5 w-full md:w-3/5 h-full mt-13 md:mt-50">
                <div class="w-4/5 line-clamp-3">
                    <h3 class="text-2xl md:text-4xl truncate text-white font-heading font-bold">Lorem, ipsum dolor.</h3>
                    <p class="text-white mt-2 text-[13px] md:text-[15px] text-ellipsis">Lorem ipsum dolor sit amet
                        consectetur adipisicing elit. Praesentium dicta nulla alias ducimus corrupti ex neque soluta
                        nobis? Vero, vel ipsum. Nobis, eos quidem praesentium delectus.</p>
                </div>
                <div class="flex gap-2 mt-10">
                    <a href=""
                        class="inline-block text-center text-sm md:text-[16px] bg-myGreen hover:bg-[#087735] focus:ring-4 focus:ring-myGreen rounded-sm text- font-semibold px-5 py-2.5 focus:outline-none">Lihat
                        Detail</a>
                    <a href=""
                        class="text-white inline-block text-center text-sm md:text-[16px] bg-slate-600 hover:bg-[#a22626] focus:ring-4 focus:ring-slate-600 rounded-sm text- font-semibold px-5 py-2.5 focus:outline-none">Tambah
                        <i class="fa-solid fa-cart-plus"></i></a>
                </div>
            </div>

            {{-- product --}}
            <div class="w-full md:w-2/5 h-full">
                <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt=""
                    loading="lazy" class="w-full h-80 md:h-full object-cover">
            </div>
        </div>
    </section>

    {{-- all product --}}
    <section class="section">
        <div class="heading-title">
            <h3 class="">All Products</h3>
            <div class="flex justify-between items-center">
                <p class="text-heading font-bold mt-3 text-2xl">Semua Produk</p>
            </div>
        </div>

        <div class="mt-10">
            <div class="swiper allProduct1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
            </div>
            <div class="swiper allProduct2 mt-5">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
                    <div class="swiper-slide">
                        <a href="" class="max-w-sm bg-white rounded-lg">
                            <div class="relative group overflow-hidden">
                                <img class="rounded-t-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" />
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
            </div>

            <div class="mt-8 q flex justify-center">
                <a href=""
                    class="text-white inline-block text-center w-60 bg-primary hover:bg-[#a22626] focus:ring-4 focus:ring-primary rounded-sm  md:text-[15px] text-sm  font-semibold px-3 py-1.5 md:px-5 md:py-2.5 focus:outline-none">Lihat
                    Semua Produk</a>
            </div>

        </div>
    </section>

    
</div>
