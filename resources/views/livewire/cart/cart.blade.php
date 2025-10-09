<div>
    <section class="my-4 flex">
        <div class="container">
            <div class="">
                <div class="mt-3 mb-5">
                    <h1 class="text-2xl md:text-3xl font-semibold font-heading">Keranjang Belanja</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                                    <i class="fa-solid fa-house me-2" wire:navigate></i>
                                    Home
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chevron-right text-sm text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Cart</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-16 py-3">
                                <span class="sr-only">Image</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sub Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="p-4">
                                <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                    alt="" loading="lazy" class="size-30 md:h-full object-cover">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <a href="" wire:navigate>Apple Watch</a>
                            </td>
                            <td class="px-6 py-4">
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
                                    <input type="number" id="quantityInput" min="0" 
                                        value="1"
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
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <span class="text-slate-800 text-[14px]"><span class="text-xs">Rp.</span>3.000.000</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <span class="text-slate-800 text-[14px]"><span class="text-xs">Rp.</span>3.000.000</span>
                            </td>
                            <td class="px-6 py-4">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2 ">Hapus</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="mt-5 sm:mt-10 flex flex-col sm:flex-row justify-between gap-4">
                <div>
                    <a href="{{ route('products') }}"
                        class="inline-block transition-all duration-500 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center me-2 mb-2" wire:navigate>Kembali
                        ke toko</a>
                </div>

                <div class="border-2 w-full sm:w-100 rounded-sm border-slate-500 px-4 py-3">
                    <p class="text-lg ">Total Harga </p>

                    <form action="" method="POST" class="mt-2">
                        @csrf
                        <div class="border-b-2 flex justify-between items-center my-2 pb-2 text-slate-600 text-sm">
                            <p>Total</p>
                            <p>$2339</p>
                            <input type="text" name="total">
                        </div>

                        <button type="submit"
                                    class="focus:outline-none text-white bg-primary hover:bg-slate-800 focus:ring-4 focus:ring-primary font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2 mt-2 w-full">Check Out</button>
                    </form>
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
