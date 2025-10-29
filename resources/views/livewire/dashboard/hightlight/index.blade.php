<div>
    <x-notifAlert />
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <x-dashboard.breadcrumb title="Hightlight Product" :items="[['name' => 'Hightlight']]" />
            <div class="my-3">
            {{-- Table placeholder --}}
            <div class="relative overflow-x-auto sm:rounded-lg bg-white">
                <x-dashboard.table>
                    <x-dashboard.table.tableThead>
                        <x-dashboard.table.headField name="No" />
                        <x-dashboard.table.headField name="Gambar" />
                        <x-dashboard.table.headField name="Nama" />
                        <x-dashboard.table.headField name="Deskripsi" />
                        <x-dashboard.table.headField name="Type" />
                        <x-dashboard.table.headField name="Status" />
                        <x-dashboard.table.headField name="Status Btn" />
                    </x-dashboard.table.tableThead>

                    {{-- tbody --}}
                    <x-dashboard.table.tableTbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <x-dashboard.table.row class="w-10 p-3">
                                    {{ $loop->iteration + ($banners->currentPage() - 1) * $banners->perPage() }}
                                </x-dashboard.table.row>

                                <x-dashboard.table.row class="w-34 p-3">
                                    <img src="{{ thumbnailCond($banner->img_banner) }}" alt="" loading="lazy">
                                </x-dashboard.table.row>

                                <x-dashboard.table.row>{{ Str::words($banner->title, 10, '...') }}</x-dashboard.table.row>

                                <x-dashboard.table.row
                                    class="w-100 p-3">{{ Str::words($banner->desc, 15, '...') }}</x-dashboard.table.row>

                                <x-dashboard.table.row class="w-14 p-3">{{ $banner->type }}</x-dashboard.table.row>

                                <x-dashboard.table.row>
                                    @if ($banner->is_active)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Aktif</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Mati</span>
                                    @endif
                                </x-dashboard.table.row>

                                <x-dashboard.table.row>
                                    @if ($banner->btn_detail)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Aktif</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Mati</span>
                                    @endif
                                </x-dashboard.table.row>


                                {{-- aksi --}}
                                <x-dashboard.table.aksiTable :data="$banner" :updatePopup="false" :productPage="false" />
                            </tr>
                        @empty
                            <tr>
                                <x-dashboard.table.row colspan="10">
                                    <p class="text-semibold text-slate-400 text-center my-2">Data tidak ada</p>
                                </x-dashboard.table.row>
                            </tr>
                        @endforelse
                    </x-dashboard.table.tableTbody>
                </x-dashboard.table>
            </div>

            {{-- Pagination placeholder --}}
            {{ $banners->links('components.custom-pagination') }}
        </div>

        <div class="bg-white rounded-lg shadow-md p-3 md:p-5 mt-2">
            <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-4">Add New Banner</h2>
            <form wire:submit='storeBanner' class="space-y-3">
                {{-- choose product (optional) --}}
                {{ $chooseProduct }}
                <div class="w-full mb-8">
                    <select id="countries" wire:model.live.debounce.200='chooseProduct'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="reset" >Pilih produk (optional)</option>
                        @forelse ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->title }} ---
                                ({{ $product->category->title }})
                            </option>
                        @empty
                            <option value="">Kosong</option>
                        @endforelse
                    </select>
                </div>


                <div class="flex flex-wrap md:flex-nowrap gap-4">
                    {{-- Col 1: title, type, active, btn  --}}
                    <div class="w-full min-h-30 max-h full ">
                        <div class="flex-1 mb-2">
                            <input type="text" placeholder="Banner Title" wire:model='title'
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex-1 mb-2">
                            <select wire:model='type'
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Type</option>
                                <option value="slider">Slider</option>
                                <option value="highlight">Highlight</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- is active --}}
                        <div class="flex gap-7 w-full">
                            <div class="mt-1">
                                <p class="mb-2 text-sm font-medium text-gray-900">Banner Active </p>
                                <label class="inline-flex items-center mb-5 cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" wire:model='is_active' >
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                            {{-- button detail --}}
                            <div class="mt-1">
                                <p class="mb-2 text-sm font-medium {{ $btnDetailCond ? 'text-gray-900' : 'text-gray-400' }}">button detail (Khusus Produk)</p>
                                <label class="inline-flex items-center mb-5 cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" wire:model='btn_detail' {{ $btnDetailCond ? '' : 'disabled' }}>
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Col2: upload img --}}
                    <div class="w-full min-h-30 max-h full ">
                        <div class="flex gap-5 items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 ">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                            upload</span></p>
                                    <p class="text-xs text-gray-500">JPEG, PNG, JPG</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" wire:model='img_banner' />
                            </label>

                            @if ($img_banner)
                                @if ($img_banner instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                    <img src="{{ $img_banner->temporaryUrl() }}" alt="" loading="lazy"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ thumbnailCond($img_banner) }}" alt="" loading="lazy"
                                        class="w-full h-full object-cover">
                                @endif
                            @endif

                            @error('img_banner')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Col3: description --}}
                    <div class="w-full min-h-30 max-h-full ">
                        <textarea placeholder="Banner description" wire:model='desc'
                            class="w-full h-40 rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
                        @error('desc')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-3 justify-end mt-5">
                    <button type="button" wire:click='resetForm'
                        class="px-6 py-2 bg-red-800 text-white font-semibold rounded-lg hover:bg-slate-700 transition">
                       Batal
                    </button>

                    <button type="submit" wire:loading.attr='false'
                        class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-slate-700 transition">
                        <i class="fas fa-plus mr-2"></i>
                        Add Banner
                        <div role="status" wire:loading wire:target="storeBanner">
                            <i class="fa-solid fa-spinner text-gray-200 animate-spin"></i>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
