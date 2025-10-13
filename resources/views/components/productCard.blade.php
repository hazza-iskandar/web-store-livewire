@props(['product'])

<div class="relative group overflow-hidden">
    <a href="{{ route('products.show', $product->slug) }}" class="max-w-sm bg-white rounded-lg" wire:navigate>
        <div class="overflow-hidden">
            @if ($product->created_at->format('Y-m-d') == \Carbon\Carbon::today()->toDateString())
                <span
                    class="absolute top-4 bg-primary text-white text-sm font-medium me-2 px-2.5 py-0.5 rounded-r-md ">Baru</span>
            @endif

            <img class="rounded-t-lg" src="{{ $product->thumbnail }}" alt="" loading="lazy" />
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

    <button type="" wire:click="addToCart('{{ $product->id }}')"
        class="absolute z-10 transition-all duration-500 group-hover:bottom-28 group-hover:opacity-100 opacity-0 bottom-25 right-0 left-0 text-center bg-black h-10 text-white cursor-pointer">
        Tambah Ke Keranjang
    </button>
</div>
