<div>
    <x-notifAlert />

    <div class="p-4 sm:ml-64">
        <x-dashboard.breadcrumb title="All Categories" :items="[['name' => 'Categories']]" />
        <div class="relative overflow-x-auto sm:rounded-lg bg-white">
            <div class="flex flex-col lg:flex-row items-center justify-between space-y-3 lg:space-y-0 lg:space-x-4 mb-3">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2 w-full">
                    <div class="relative">
                        <input type="text" placeholder="Search Category.." wire:model.live='search'
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full focus:ring-primary focus:border-primary outline-none">
                        <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                            <i class="fas fa-search text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex my-3 justify-between" x-data="{ openDeleteModal: false }">
                <div class="flex gap-3">
                    <button wire:click='selectBtn'
                        class="text-white bg-primary hover:bg-primary-dark focus:ring-4 cursor-pointer font-medium rounded-lg text-sm px-4 py-2 text-center">
                        @if ($selectBtnCond)
                            Close Select Item
                        @else
                            Select Item
                        @endif
                    </button>
                    @if ($selectBtnCond)
                        <button @click="openDeleteModal= true"
                            class="text-white bg-primary hover:bg-primary-dark focus:ring-4 cursor-pointer font-medium rounded-lg text-sm px-4 py-2 text-center">
                            <i class="fa-solid fa-trash me-1"></i> Delete Items
                        </button>
                        <x-modal2 show="openDeleteModal">
                            <i class="fa-solid fa-triangle-exclamation text-red-500 text-4xl mb-3"></i>
                            <h2 class="text-lg font-semibold mb-2">Hapus Data?</h2>
                            <p class="text-gray-600 mb-4">Apakah kamu yakin ingin menghapus data ini? Semua <span
                                    class="text-bold">
                                    Product Kategori Terkait akan terhapus</span> Tindakan ini
                                tidak
                                dapat
                                dibatalkan.</p>

                            <div class="flex justify-center space-x-3">
                                <button @click="openDeleteModal = false"
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                                {{-- data dari komponen akan di terima index categories --}}
                                <button wire:click='deleteItem' @click="openDeleteModal = false"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </div>
                        </x-modal2>
                    @endif
                </div>

                <div x-data="{ openModalCreate: false }">
                    <button @click="openModalCreate= true" wire:click='createReset'
                        class="text-white bg-primary hover:bg-primary-dark focus:ring-4 cursor-pointer font-medium rounded-lg text-sm px-4 py-2 text-left">
                        <i class="fa-solid fa-square-plus me-1"></i>
                        Tambah Category
                    </button>
                    <x-modal2 show="openModalCreate" class="w-120">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center">Tambah Category
                        </h2>

                        <form wire:submit="storeCategory" class="space-y-6">
                            {{-- title --}}
                            <div>
                                <label class="block text-start mb-2 text-sm font-medium text-gray-700">Judul
                                    Category</label>
                                <input type="text" wire:model.live.debounce.300="title"
                                    class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                    placeholder="Masukkan judul Category">
                                @error('title')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- desc  --}}
                            <div>
                                <label class="block text-start mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea wire:model="desc" rows="4"
                                    class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                    placeholder="Tulis deskripsi category..."></textarea>
                                @error('desc')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- submit --}}
                            <div class="flex justify-end space-x-3 pt-4 border-t">
                                <button type="button" @click="openModalCreate = false"
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                                    Batal
                                </button>
                                <button type="submit" wire:loading.attr='false' wire:loading.class="bg-[#980e0e]"
                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                                    <i class="fa-solid fa-square-plus me-1"></i> Tambah
                                    <div role="status" wire:loading wire:target="storeCategory">
                                        <i class="fa-solid fa-spinner text-gray-200 animate-spin"></i>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </x-modal2>

                </div>
            </div>

            <x-dashboard.table.table>
                <x-dashboard.table.tableThead>
                    @if ($selectBtnCond)
                        <x-dashboard.table.headField>
                            <input id="select-all" type="checkbox" wire:model.live='selectAll'
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                        </x-dashboard.table.headField>
                    @endif
                    <x-dashboard.table.headField name="No" />
                    <x-dashboard.table.headField name="Tanggal" />
                    <x-dashboard.table.headField name="Nama" />
                    <x-dashboard.table.headField name="Deskripsi" />
                </x-dashboard.table.tableThead>

                <x-dashboard.table.tableTbody>
                    @forelse ($categories as $category)
                        <tr>
                            @if ($selectBtnCond)
                                <x-dashboard.table.row class="w-10 p-3">
                                    <input id="select-all" type="checkbox" wire:model.live='selectedId'
                                        value="{{ $category->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                </x-dashboard.table.row>
                            @endif
                            <x-dashboard.table.row class="w-10 p-3">
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </x-dashboard.table.row>

                            <x-dashboard.table.row class="w-30 p-4">
                                {{ date_format($category->created_at, 'Y-m-d') }}
                            </x-dashboard.table.row>

                            <x-dashboard.table.row class="w-30 p-4">
                                {{ $category->title }}
                            </x-dashboard.table.row>

                            <x-dashboard.table.row>
                                {{ Str::words($category->desc, 20, '...') }}
                            </x-dashboard.table.row>

                            <x-dashboard.table.aksiTable :data="$category" :productPage="false">
                                {{-- untuk edit --}}
                                <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center">Tambah Category
                                </h2>
                                <form wire:submit="updateCategory({{ $category->id }})" class="space-y-6">
                                    {{-- title --}}
                                    <div>
                                        <label class="block text-start mb-2 text-sm font-medium text-gray-700">Judul
                                            Category</label>
                                        <input type="text" wire:model.live.debounce.300="title"
                                            class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                            placeholder="Masukkan judul Category">
                                        @error('title')
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- desc  --}}
                                    <div>
                                        <label
                                            class="block text-start mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea wire:model="desc" rows="4"
                                            class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                            placeholder="Tulis deskripsi category..."></textarea>
                                        @error('desc')
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- submit --}}
                                    <div class="flex justify-end space-x-3 pt-4 border-t">
                                        <button type="submit" wire:loading.attr='false'
                                            wire:loading.class="bg-[#980e0e]"
                                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> update
                                            <div role="status" wire:loading wire:target="updateCategory">
                                                <i class="fa-solid fa-spinner text-gray-200 animate-spin"></i>
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            </x-dashboard.table.aksiTable>
                        </tr>

                    @empty
                        <tr>
                            <x-dashboard.table.row colspan="5">
                                <p class="text-semibold text-slate-400 text-center my-2">Data tidak ada</p>
                            </x-dashboard.table.row>
                        </tr>
                    @endforelse
                </x-dashboard.table.tableTbody>
            </x-dashboard.table.table>
            <div class="mt-4">
                {{ $categories->links('components.custom-pagination') }}
            </div>
        </div>
    </div>
</div>
