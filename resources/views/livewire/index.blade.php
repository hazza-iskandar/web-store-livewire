<div class="container">
    <x-notifAlert />
    <div class="mt-2 w-full h-130 shadow-md">
        <div class="swiper jumbtron rounded-xl" wire:ignore>
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide relative">
                        <img src="{{ thumbnailCond($slider->img_banner ?? '') }}" alt="" loading="lazy">
                        <div class="absolute inset-0 bg-[#00000048] px-6 md:px-10 flex flex-col justify-end pb-10">

                            <div class="w-80 md:w-200 text-start line-clamp-3 mb-20 lg:mb-30">
                                <p class="font-bold text-sm md:text-lg text-primary">{{ $slider->category->title }}</p>
                                <h3 class="font-bold text-2xl lg:text-4xl text-slate-200">{{ $slider->title }}</h3>
                            </div>
                            <a href="{{ route('products.show', $slider->product->slug ) }}" wire:navigate
                                class="text-white text-center w-40 bg-primary transition-all hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Lihat
                                Produk <i class="fa-solid fa-bag-shopping"></i></a>

                        </div>
                    </div>
                @endforeach
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
            <div class="swiper newProduct" wire:ignore>
                <div class="swiper-wrapper">
                    @foreach ($newProducts as $newProduct)
                        <div class="swiper-slide">
                            <x-productCard :product="$newProduct" />
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 q flex justify-center">
                <a href="{{ route('products.index') }}" wire:navigate
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
            </div>
        </div>

        <div class="mt-10">
            <div class="swiper category" wire:ignore>
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide ">
                            <a href="{{ route('products.index', ['category' => $category->title]) }}" wire:navigate
                                class="inline-block w-full text-center border-2 border-slate-400 rounded-sm p-2 hover:border-primary hover:bg-primary hover:text-white transition-all">
                                <p>{{ $category->title }}</p>
                            </a>
                        </div>
                    @endforeach
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
                    <h3 class="text-2xl md:text-4xl truncate text-white font-heading font-bold">{{ $hightlight->title ?? '' }}
                    </h3>
                    <p class="text-white mt-2 text-[13px] md:text-[15px] text-ellipsis">{{ $hightlight->desc ?? '' }}</p>
                </div>
                <div class="flex gap-2 mt-10">
                    <a href="{{ route('products.show', $hightlight->product->slug ?? '#') }}" wire:navigate
                        class="inline-block text-center text-sm md:text-[16px] bg-myGreen hover:bg-[#087735] focus:ring-4 focus:ring-myGreen rounded-sm text- font-semibold px-5 py-2.5 focus:outline-none">Lihat
                        Detail</a>
                    <button wire:click="addToCart('{{ $hightlight->product->id ?? '' }}')"
                        class="text-white inline-block text-center text-sm md:text-[16px] bg-slate-600 hover:bg-[#a22626] focus:ring-4 focus:ring-slate-600 rounded-sm text- font-semibold px-5 py-2.5 focus:outline-none">Tambah
                        <i class="fa-solid fa-cart-plus"></i></button>
                </div>
            </div>

            {{-- product --}}
            <div class="w-full md:w-2/5 h-full">
                <img src="{{ thumbnailCond($hightlight->img_banner ?? '')  }}" alt="" loading="lazy"
                    class="w-full h-80 md:h-full object-cover">
            </div>
        </div>
    </section>

    {{-- all product --}}
    <section class="section">
        <div class="heading-title">
            <h3 class="">All Products</h3>
            <div class="flex justify-between items-center">
                <p class="text-heading font-bold mt-3 text-2xl">Semua Produk Kami</p>
            </div>
        </div>

        <div class="mt-10">
            <div class="swiper allProduct1" wire:ignore>
                <div class="swiper-wrapper">
                    @foreach ($allProduct1 as $product)
                        <div class="swiper-slide">
                            <x-productCard :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper allProduct2 mt-5" wire:ignore>
                <div class="swiper-wrapper">
                    @foreach ($allProduct2 as $product)
                        <div class="swiper-slide">
                            <x-productCard :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 q flex justify-center">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="text-white inline-block text-center w-60 bg-primary hover:bg-[#a22626] focus:ring-4 focus:ring-primary rounded-sm  md:text-[15px] text-sm  font-semibold px-3 py-1.5 md:px-5 md:py-2.5 focus:outline-none">Lihat
                    Semua Produk</a>
            </div>

        </div>
    </section>


</div>
