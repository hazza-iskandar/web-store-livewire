@props([
    'data' => null,
    'productPage' => true,
    'updatePopup' => true,
])
<td x-data="{ openDropdown: false, openModal: false, openDeleteModal: false, openViewModal: false }" class="relative text-center">
    <i class="fas fa-ellipsis-v text-gray-500 hover:text-primary cursor-pointer"
        @click="openDropdown = !openDropdown"></i>
    {{-- dropdown --}}
    <div x-show="openDropdown" x-cloak @click.outside="openDropdown = false" x-transition
        class="absolute z-222 right-0 mt-2 w-30 bg-white shadow-md rounded-md text-start">
        <button @click="openModal = true; openDropdown = false" class="block w-full text-start p-3 hover:bg-gray-100"
            x-on:click="$wire.dispatch('updateItem', { id: {{ $data->id }} })"><i
                class="fa-solid fa-pen-to-square me-1"></i>
            Edit</button>
        @if ($productPage)
            <button @click="openViewModal = true; openDropdown = false"
                class="block w-full text-start p-3 hover:bg-gray-100"><i class="fa-solid fa-eye me-1"></i>
                Preview</button>
        @endif
        <button @click="openDeleteModal= true; openDropdown= false"
            class="block w-full text-start p-3 text-red-600 hover:bg-red-100"><i class="fa-solid fa-trash me-2"></i>
            Delete</button>
    </div>

    {{-- modal detail product --}}
    @if ($updatePopup)
        <x-modal2 show="openModal" class="w-160">
            {{ $slot }}
        </x-modal2>
    @endif

    {{-- modal delete --}}
    <x-modal2 show="openDeleteModal">

        <i class="fa-solid fa-triangle-exclamation text-red-500 text-4xl mb-3"></i>
        <h2 class="text-lg font-semibold mb-2">Hapus Data?</h2>
        <p class="text-gray-600 mb-4">Apakah kamu yakin ingin menghapus data ini? Tindakan ini tidak dapat
            dibatalkan.</p>

        <div class="flex justify-center space-x-3">
            <button @click="openDeleteModal = false"
                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Batal
            </button>
            {{-- data dari komponen akan di terima index products --}}
            <button x-on:click="$wire.dispatch('deleteItem', { id: {{ $data->id }} })"
                @click="openDeleteModal = false" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Hapus
            </button>
        </div>
    </x-modal2>

    <!-- Modal -->
    {{-- jadi nanti ini hanya akan muncul di product saja --}}
    @if ($productPage)
        <x-modal2 show="openViewModal" width="max-w-130">
            <!-- Banner Image Swiper -->
            <div class="relative w-full h-60 sm:h-72 md:h-80">
                <div class="swiper showProduct">
                    <div class="swiper-wrapper">
                        @if (!empty($data->images))
                            @foreach (array_filter(json_decode($data->images, true) ?? []) as $slider)
                                <div class="swiper-slide">
                                    <img src="{{ thumbnailCond($slider) }}" alt="slider"
                                        class="w-full h-full object-cover rounded-t-2xl" loading="lazy">
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <img src="{{ thumbnailCond($data->thumbnail) }}" alt="thumbnail"
                                    class="w-full h-full object-cover rounded-t-2xl" loading="lazy">
                            </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="absolute top-5 z-999 left-5 bg-primary text-white rounded-md px-3 py-1 text-sm font-medium">
                    {{ $data->category->title }}
                </div>
                <div
                    class="absolute top-16 z-999 left-5 bg-green-100 text-green-800 rounded-md px-3 py-1 text-sm font-medium">
                    {!! formatRupiah($data->price) !!}
                </div>
            </div>

            <!-- Content Info -->
            <div class="p-3 space-y-4">
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $data->title }}</h2>
                <p class="text-gray-600 text-sm sm:text-base">
                    {{ Str::words($data->desc, 30, '...') }}
                </p>

                <!-- Additional Info Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4 text-sm sm:text-base text-gray-700">
                    <div>
                        <span class="font-medium">Kategori:</span> {{ $data->category->title ?? '-' }}
                    </div>
                    <div>
                        <span class="font-medium">Stock:</span> {{ $data->stock }}
                    </div>
                    <div>
                        <span class="font-medium">Dibuat:</span> <br> {{ $data->created_at->diffForHumans() }}
                    </div>
                    {{-- <div class="sm:col-span-2">
                        <span class="font-medium">Created At:</span> 19 Oktober 2025
                    </div> --}}
                </div>

                <!-- Close Button -->
                <div class="mt-6 text-center">
                    <button @click="openViewModal = false"
                        class="px-6 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </x-modal2>
    @endif

</td>
