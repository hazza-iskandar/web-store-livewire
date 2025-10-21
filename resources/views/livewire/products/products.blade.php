<div>
    {{-- notif --}}
    <x-notifAlert />

    <section class="my-4 flex">
        <div class="container">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mt-3 mb-5">
                    <h1 class="text-3xl font-semibold font-heading">Products</h1>
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
                    {{-- <h2>Search:</h2> --}}
                    <div class="max-w-lg mx-auto">
                        <div class="flex">
                            <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                                type="button">{{ isset($categorySelected) ? $categorySelected : 'Categories' }} <svg
                                    class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>
                            <div id="dropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button">
                                    <li>
                                        <a href="{{ route('products.index') }}" wire:navigate wire:click="resetCategory"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Semua Kategori</a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li>
                                            <button type="button" wire:click="searcCategory('{{ $category->title }}')"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">{{ $category->title }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="relative w-full">
                                <input type="search" id="search-dropdown"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-primary outline-none focus:border-primary"
                                    placeholder="Cari Product" wire:model.live.debounce.300ms="search" required />
                                <button type="button"
                                    class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if (!empty($products))
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-7 ">
                    @forelse ($products as $product)
                        <div class="mt-1 sm:mt-3">
                            <x-productCard :product="$product" />
                        </div>
                    @empty
                        <div class="w-full flex justify-center h-100 pt-8">
                            <p class="text-center text-lg md:text-2xl text-slate-600">
                                <i class="fa-solid fa-ban"></i>
                                Tidak ditemukan
                            </p>
                        </div>
                    @endforelse
                </div>

                {{ $products->links('components.custom-pagination') }}
                {{-- pagination --}}
            @else
                <div class="w-full flex justify-center h-100 pt-8">
                    <p class="text-center text-lg md:text-2xl text-slate-600">
                        <i class="fa-solid fa-ban"></i>
                        Tidak ada Product
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>
