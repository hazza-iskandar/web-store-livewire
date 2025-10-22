<div>
    <x-notifAlert />
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <x-dashboard.breadcrumb title="Draft Products" :items="[['name' => 'Products', 'url' => route('dashboard.products.index')], ['name' => 'Draft']]" />
        <div class="relative overflow-x-auto sm:rounded-lg bg-white">
            <div class="flex flex-col lg:flex-row items-center justify-between space-y-3 lg:space-y-0 lg:space-x-4 mb-3">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2 w-full">
                    <div class="relative">
                        <input type="text" placeholder="Search Product.." wire:model.live='search'
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full focus:ring-primary focus:border-primary outline-none">
                        <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                            <i class="fas fa-search text-gray-500"></i>
                        </div>
                    </div>
                    <select
                        class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2 text-gray-700"
                        wire:model.live='categorySelected'>
                        <option selected value="">Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->title }}"
                                {{ $categorySelected == $category->title ? 'selected' : '' }}>{{ $category->title }}
                            </option>
                        @endforeach
                    </select>
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
                            <p class="text-gray-600 mb-4">Apakah kamu yakin ingin menghapus data ini? Tindakan ini
                                tidak
                                dapat
                                dibatalkan.</p>

                            <div class="flex justify-center space-x-3">
                                <button @click="openDeleteModal = false"
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                                {{-- data dari komponen akan di terima index products --}}
                                <button wire:click='deleteItem' @click="openDeleteModal = false"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </div>
                        </x-modal2>
                    @endif
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
                    <x-dashboard.table.headField name="Gambar" />
                    <x-dashboard.table.headField name="Nama" />
                    <x-dashboard.table.headField name="Kategori" />
                    <x-dashboard.table.headField name="Stock" />
                    <x-dashboard.table.headField name="Harga" />
                    <x-dashboard.table.headField name="Status" />
                    <x-dashboard.table.headField name="Status Stok" />
                </x-dashboard.table.tableThead>

                <x-dashboard.table.tableTbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            @if ($selectBtnCond)
                                <x-dashboard.table.row class="w-10 p-3">
                                    <input id="select-all" type="checkbox" wire:model.live='selectedId'
                                        value="{{ $product->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                </x-dashboard.table.row>
                            @endif
                            <x-dashboard.table.row
                                class="w-10 p-3">{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</x-dashboard.table.row>

                            <x-dashboard.table.row
                                class="w-30 p-3">{{ date_format($product->created_at, 'Y-m-d') }}</x-dashboard.table.row>
                            <x-dashboard.table.row class="w-30 p-3">
                                <img src="{{ thumbnailCond($product->thumbnail) }}" alt="" class="object-cover"
                                    loading="lazy">
                            </x-dashboard.table.row>
                            <x-dashboard.table.row>{{ $product->title }}</x-dashboard.table.row>
                            <x-dashboard.table.row
                                class="w-30 p-3">{{ $product->category->title }}</x-dashboard.table.row>
                            <x-dashboard.table.row class="w-30 p-3">{{ $product->stock }}</x-dashboard.table.row>
                            <x-dashboard.table.row class="w-30 p-3">{!! formatRupiah($product->price) !!}</x-dashboard.table.row>
                            <x-dashboard.table.row class="w-30 p-3">
                                <span
                                    class="bg-primary text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">{{ $product->status }}</span>
                            </x-dashboard.table.row>
                            <x-dashboard.table.row class="w-30 p-3">
                                @if ($product->stock >= 1)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Tersedia</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Habis</span>
                                @endif
                            </x-dashboard.table.row>

                            {{-- aksi --}}
                            <x-dashboard.table.aksiTable :data="$product">
                                {{-- update data --}}
                                <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center">Edit Product
                                </h2>

                                <form wire:submit="updateProduct({{ $product->id }})" class="space-y-6">
                                    <!-- Group 1: Informasi Utama -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-start mb-2 text-sm font-medium text-gray-700">Judul
                                                Produk</label>
                                            <input type="text" wire:model.live.debounce.300="title"
                                                class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                placeholder="Masukkan judul produk">
                                            @error('title')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-start mb-2 text-sm font-medium text-gray-700">Slug</label>
                                            <input type="text" wire:model="slug" readonly
                                                class="border border-gray-300 bg-gray-160 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                placeholder="slug-produk">
                                            @error('slug')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-start mb-2 text-sm font-medium text-gray-700">Kategori</label>
                                            <select wire:model="category"
                                                class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Group 2: Harga, Stok, Status -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label
                                                class="block text-start mb-2 text-sm font-medium text-gray-700">Harga</label>
                                            <input type="number" wire:model="price"
                                                class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                placeholder="Masukkan harga">
                                            @error('price')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-start mb-2 text-sm font-medium text-gray-700">Stok</label>
                                            <input type="number" wire:model="stock"
                                                class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                placeholder="Jumlah stok">
                                            @error('stock')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-start mb-2 text-sm font-medium text-gray-700">Status</label>
                                            <select wire:model="status"
                                                class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                                <option value="">Pilih Status</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                            @error('status')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Group 3: Deskripsi dan Media -->
                                    <div class="my-2 mb-6">
                                        <div>
                                            <label
                                                class="block text-start mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                                            <textarea wire:model="desc" rows="4"
                                                class="border border-gray-300 outline-none text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                placeholder="Tulis deskripsi produk..."></textarea>
                                            @error('desc')
                                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-4 flex gap-3">
                                            <!-- Thumbnail Upload -->
                                            <div class="w-full my-3">
                                                <label
                                                    class="block mb-2 text-sm font-medium text-gray-700">Thumbnail</label>
                                                <label
                                                    class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                                    <div class="flex flex-col items-center space-y-1">
                                                        <i class="fa-solid fa-image text-3xl text-primary"></i>
                                                        <span class="text-sm text-gray-600 font-medium">Pilih
                                                            Thumbnail</span>
                                                        <span class="text-xs text-gray-400">PNG, JPG, JPEG • Maks
                                                            2MB</span>
                                                    </div>
                                                    <input type="file" wire:model="thumbnail" class="hidden" />
                                                </label>
                                                @error('thumbnail')
                                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                                @if ($thumbnail)
                                                    @if (!is_string($thumbnail))
                                                        <div class="w-16 h-16 rounded-md my-5">
                                                            <img src="{{ $thumbnail->temporaryUrl() }}"
                                                                alt="" loading="lazy"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    @else
                                                        <div class="w-16 h-16 rounded-md my-5">
                                                            <img src="{{ asset('storage/' . $thumbnail) }}"
                                                                alt="" loading="lazy"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>


                                            <!-- Multi Image Upload -->
                                            <div class="w-full my-3">
                                                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar
                                                    Slider</label>
                                                <label
                                                    class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                                    <div class="flex flex-col items-center space-y-1">
                                                        <i class="fa-solid fa-images text-3xl text-primary"></i>
                                                        <span class="text-sm text-gray-600 font-medium">Upload Beberapa
                                                            Gambar</span>
                                                        <span class="text-xs text-gray-400">Dapat pilih banyak
                                                            file</span>
                                                    </div>
                                                    <input type="file" wire:model.live="images" multiple
                                                        class="hidden" />
                                                </label>
                                                @error('images')
                                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                                @if ($images)
                                                    @if (!is_array($images))
                                                        <div class="flex gap-2 flex-wrap my-5">
                                                            @foreach ($images as $image)
                                                                <div class="w-16 h-16 rounded-md">
                                                                    <img src="{{ $image->temporaryUrl() }}"
                                                                        alt="" loading="lazy"
                                                                        class="w-full h-full object-cover">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="flex gap-2 flex-wrap my-5">
                                                            @foreach ($images as $image)
                                                                <div class="w-16 h-16 rounded-md">
                                                                    <img src="{{ asset('storage/' . $image) }}"
                                                                        alt="" loading="lazy"
                                                                        class="w-full h-full object-cover">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="flex justify-end space-x-3 pt-4 border-t">
                                        <button type="submit"
                                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </x-dashboard.table.aksiTable>
                        </tr>
                    @empty
                        <tr>
                            <x-dashboard.table.row colspan="10">
                                <p class="text-semibold text-slate-400 text-center my-2">Data tidak ada</p>
                            </x-dashboard.table.row>
                        </tr>
                    @endforelse
                </x-dashboard.table.tableTbody>
            </x-dashboard.table.table>

            <div class="mt-4">
                {{ $products->links('components.custom-pagination') }}
            </div>
        </div>
    </div>
</div>
