@props(['product'])

<div class="relative group overflow-hidden">
    <a href="{{ route('products.show', $product->slug) }}" class="max-w-sm bg-white rounded-lg" wire:navigate>
        <div class="overflow-hidden">
            @if ($product->created_at->between(today(), today()->addDays(5))) {{--  ambil hari ini dan 5 hari kedepan --}}
                <span
                    class="absolute top-4 bg-primary text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-r-md ">Baru</span>
            @endif

            <img class="rounded-t-lg" src="{{ thumbnailCond($product->thumbnail) }}" alt="" loading="lazy" />
        </div>
        <div class="pt-2">
            <h5 class="text-[16px] sm:text-lg font-normal tracking-tight text-slate-900 truncate">
                {{ $product->title }}
            </h5>
        </div>
        <div class="pt-2">
            <p class="text-primary text-sm md:text-lg">{!! formatRupiah($product->price) !!}</p>
            <p class="mt-2 text-slate-600 sm:text-sm md:block hidden">
                {{ Str::words($product->desc, 8, '...') }}</p>
        </div>
    </a>

    <button type="button" wire:click="addToCart('{{ $product->id }}')"
        class="hidden md:block absolute z-10 transition-all duration-500 group-hover:bottom-28 group-hover:opacity-100 opacity-0 bottom-25 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
        Tambah Ke Keranjang
    </button>
</div>
