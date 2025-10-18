<div>
    <x-notifAlert />
    {{-- @dd($orde) --}}
    <section class="my-6 flex">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex mb-10 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center text-gray-700 hover:text-primary transition">
                            <i class="fa-solid fa-house me-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400 mx-2"></i>
                            <a href="{{ route('products.index') }}" wire:navigate class="text-gray-700 hover:text-primary transition">Produk</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400 mx-2"></i>
                            <span class="text-primary font-medium">Pesanan</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- Main Content --}}
            <form class="flex flex-col lg:flex-row gap-8">
                {{-- Kiri: Data Pemesan --}}
                <div class="w-full lg:w-1/2 bg-white rounded-2xl shadow-md p-6 md:p-8">
                    <div class="flex justify-between items-center mb-5 border-b pb-3">
                        <h2 class="text-lg md:text-xl font-semibold text-gray-800">Data Pemesan</h2>
                        <a href="{{ route('account.profile') }}" wire:navigate
                            class="text-sm md:text-base text-primary hover:text-slate-800 font-medium flex items-center gap-1 transition">
                            <i class="fa-solid fa-pen text-xs"></i> Edit
                        </a>
                    </div>

                    <div class="space-y-4 text-sm md:text-base">
                        <div>
                            <label class="block text-gray-500 mb-1">Nama Lengkap</label>
                            <p class="text-gray-800 font-medium">{{ $user->profile->fullname ?? 'belum ada nama' }}</p>
                        </div>

                        <div>
                            <label class="block text-gray-500 mb-1">Alamat Lengkap</label>
                            <p class="text-gray-800 leading-relaxed">{{ $user->profile->adress ?? 'belum ada alamat' }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-gray-500 mb-1">Kode Order</label>
                            <p class="text-gray-800 leading-relaxed">{{ $codeOrder }}
                            </p>
                        </div>
                    </div>

                    {{-- Kupon --}}
                    {{-- <div class="mt-10">
                        <h2 class="text-base md:text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Kode Voucer</h2>

                        <div class="relative">
                            <input type="text" id="voucer" name="voucer" placeholder="Masukkan kode kupon"
                                class="block w-full rounded-lg border border-gray-300 pr-24 pl-4 py-3 text-gray-900 focus:ring-primary focus:border-primary placeholder-gray-400 text-sm md:text-base" />

                            <button type="button"
                                class="absolute top-1/2 right-2 -translate-y-1/2 bg-primary text-white font-medium text-xs md:text-sm px-4 py-1.5 rounded-md hover:bg-primary/90 focus:ring-2 focus:ring-primary focus:outline-none transition">
                                Check
                            </button>
                        </div>

                        <p class="text-xs md:text-sm text-gray-500 mt-2">Masukkan kode kupon untuk mendapatkan potongan
                            harga.</p>
                    </div> --}}
                </div>

                {{-- Kanan: Ringkasan Pesanan --}}
                <div class="w-full lg:w-1/2 bg-white rounded-2xl shadow-md p-6 md:p-8">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-4 border-b pb-3">Ringkasan Pesanan</h2>

                    <div class="divide-y h-80 max-h-50 overflow-scroll">
                        @if ($orders->count() > 1)
                            @foreach ($orders as $order)
                                {{-- Item 1 --}}
                                <div class="flex items-center justify-between py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ thumbnailCond($order->product->thumbnail) }}"
                                            class="w-16 h-16 rounded-lg object-cover" alt="">
                                        <div class=" w-full md:w-80">
                                            <p class="text-sm md:text-base font-medium text-gray-800 truncate">
                                                {{ $order->product->title }}</p>
                                            <p class="text-xs md:text-sm text-gray-500">x{{ $order->qty }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm md:text-base font-semibold text-gray-800">{!! formatRupiah($order->total_price) !!}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            {{-- Item 1 --}}
                            <div class="flex items-center justify-between py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ thumbnailCond($orders[0]->product->thumbnail) }}"
                                        class="w-16 h-16 rounded-lg object-cover" alt="">
                                    <div class=" w-full md:w-80">
                                        <p class="text-sm md:text-base font-medium text-gray-800 truncate">
                                            {{ $orders[0]->product->title }}</p>
                                        <p class="text-xs md:text-sm text-gray-500">x{{ $orders[0]->qty }}</p>
                                    </div>
                                </div>
                                <p class="text-sm md:text-base font-semibold text-gray-800">{!! formatRupiah($orders[0]->total_price) !!}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div
                        class="border-t mt-5 pt-4 flex justify-between text-gray-700 font-semibold text-sm md:text-base">
                        <p>Total</p>
                        <p>{!! formatRupiah($total_price) !!}</p>
                    </div>

                    <button type="button"
                        class="w-full mt-6 bg-primary text-white font-medium py-3 md:py-3.5 rounded-lg hover:bg-slate-800 transition text-sm md:text-base">
                        Buat Pesanan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
