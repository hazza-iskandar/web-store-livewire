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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">404</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="flex flex-col gap-3 justify-center items-center h-100 text-center">
        <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl text-slate-800 font-bold font-heading">404 Not Found
        </h1>
        <p class="text-sm sm:text-xl">Halaman ini tidak ditemukan silankan kembali!</p>

        <a href="{{ route('home') }}"
            class="ext-white bg-primary hover:bg-slate-700 focus:outline-none focus:ring-4 focus:ring-primary font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2 text-white" wire:navigate>Kembali
            halaman home</a>
    </div>
</div>
