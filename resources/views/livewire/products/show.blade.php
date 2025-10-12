<div>
    <section class="my-4 flex">
        <div class="container">
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
                            <a href="{{ route('products.index') }}"
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

            <div class="mt-10">
                <div class="flex sm:flex-row flex-col">
                    <div class="w-full sm:w-1/2 mb-5">
                        <div class="swiper showProduct">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    {{-- perbiaki ini ketika ada image --}}
                                    @if (!empty($images))
                                        @foreach ($images as $image)
                                            <img src="{{ $image }}" class="h-100 rounded-md shadow-md"
                                                alt="" loading="lazy">
                                        @endforeach
                                    @else
                                        <img src="{{ $thumbnail }}" class="h-100 rounded-md shadow-md" alt=""
                                            loading="lazy">
                                    @endif
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="w-full sm:w-1/2 sm:ms-8 ">
                        <div class="pb-4 border-b-3 border-slate-600">
                            <h1 class="font-heading text-2xl sm:text-3xl mb-1">{{ $product->title }}</h1>
                            <a href="{{ route('categories', $product->category->slug) }}"
                                class="sm:text-[16px] text-sm me-4">{{ $product->category->title }}</a>
                            <span
                                class="text-white bg-green-100 {{ $product->stock == 0 ? 'bg-red-600' : 'bg-green-700' }} text-xs sm:text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm">Stok
                                tersedia {{ $product->stock }}</span>

                            <p class="mt-2 text-primary text-xl sm:text-2xl">
                                {!! formatRupiah($product->price) !!}</p>
                            <p class="text-slate-700 mt-2 sm:mt-4 sm:text-[16px] text-sm">{{ $product->desc }}</p>
                        </div>
                        @if (!$product->stock == 0 || !empty($product->stock))
                            <div class="mt-5 flex gap-3">
                                <a href="" type="button"
                                    class="text-white inline-block mt-3 w-full bg-primary hover:bg-slate-800 focus:outline-none text-sm sm:text-lg focus:ring-4 focus:ring-blue-300 font-medium rounded-sm px-3 py-1.5 sm:px-5 sm:py-2.5 text-center me-2 mb-2">Beli</a>
                                <form action="" method="POST" class="w-full">
                                    <button type="submit"
                                        class="text-white inline-block mt-3 bg-green-600 w-full hover:bg-green-800 focus:outline-none text-sm sm:text-lg focus:ring-4 focus:ring-blue-300 font-medium rounded-sm px-3 py-1.5 sm:px-5 sm:py-2.5 text-center me-2 mb-2">Keranjang</a>
                                </form>
                            </div>
                        @endif
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
                        @foreach ($products as $product)
                            <div class="swiper-slide">
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="max-w-sm bg-white rounded-lg">
                                    <div class="relative group overflow-hidden">
                                        @if ($product->created_at->format('Y-m-d') == \Carbon\Carbon::today()->toDateString())
                                            <span
                                                class="absolute top-4 bg-primary text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-r-md ">Baru</span>
                                        @endif

                                        <img class="rounded-t-lg" src="{{ $product->thumbnail }}" alt=""
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
                                        <h5
                                            class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900 truncate">
                                            {{ $product->title }}
                                        </h5>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-primary text-sm md:text-lg">{!! formatRupiah($product->price) !!}</p>
                                        <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">
                                            {{ Str::words($product->desc, 8, '...') }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
