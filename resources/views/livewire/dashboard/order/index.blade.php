<div>
    <x-notifAlert />
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <x-dashboard.breadcrumb title="All Products" :items="[['name' => 'Order Products']]" />
        {{-- tabel --}}
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
                        <label
                            class="text-white bg-primary hover:bg-primary-dark focus:ring-4 cursor-pointer font-medium rounded-lg text-sm px-4 py-2 text-center">
                            Select All
                            <input id="select-all" type="checkbox" wire:model.live='selectAll' hidden
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                        </label>


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

            @forelse ($orders as $code => $items)
                <div class="my-4 overflow-x-auto">
                    <div class="flex gap-3">
                        @if ($selectBtnCond)
                            <x-dashboard.table.row class="w-10 p-3">
                                <input id="select-all" type="checkbox" wire:model.live='selectedCode'
                                    value="{{ $code }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                            </x-dashboard.table.row>
                        @endif
                        <p class="text-heading text-slate-800 text-sm">Code Order: <span
                                class="font-bold">{{ $code }}</span></p>
                    </div>
                    <x-dashboard.table.table>
                        <x-dashboard.table.tableThead :action="false">
                            <x-dashboard.table.headField name="Nama Barang" />
                            <x-dashboard.table.headField name="Jumlah" />
                            <x-dashboard.table.headField name="Harga" />
                            <x-dashboard.table.headField name="Total Harga" />
                            <x-dashboard.table.headField name="Status Oder" />
                            <x-dashboard.table.headField name="Kode Order" />
                            <x-dashboard.table.headField name="Tangal" />
                        </x-dashboard.table.tableThead>

                        <x-dashboard.table.tableTbody>
                            @foreach ($items as $order)
                                <tr>
                                    <x-dashboard.table.row>{{ Str::words($order->product->title, '3', '...') }}</x-dashboard.table.row>
                                    <x-dashboard.table.row class="w-30 p-3">{{ $order->qty }}x</x-dashboard.table.row>
                                    <x-dashboard.table.row>{!! formatRupiah($order->price) !!}</x-dashboard.table.row>
                                    <x-dashboard.table.row>{!! formatRupiah($order->total_price) !!}</x-dashboard.table.row>
                                    <x-dashboard.table.row>
                                        @if ($order->status == 'pending')
                                            <span
                                                class="bg-red-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Pending</span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Completed</span>
                                        @endif
                                    </x-dashboard.table.row>
                                    <x-dashboard.table.row>{{ $order->order_code_group ?? $order->order_code }}</x-dashboard.table.row>
                                    <x-dashboard.table.row>{{ Carbon\Carbon::parse($order->date)->format('Y M d') }}</x-dashboard.table.row>

                                </tr>
                            @endforeach
                        </x-dashboard.table.tableTbody>
                    </x-dashboard.table.table>
                    <div class="bg-gray-200 p-1 px-3">
                        <p class="text-sm text-semibold text-end">Total: {!! formatRupiah($items->flatten()->sum('total_price')) !!}</p>
                    </div>
                </div>
            @empty
                <p class="text-center font-semibold text-slate-400">Tidak ada data</p>
            @endforelse

            {{-- {{ $paginator->links('components.custom-pagination') }} --}}

            @if ($paginator->hasMorePages())
                <div x-intersect="$wire.loadMore()" class="flex justify-center py-4 transition-opacity">
                    <div class="w-6 h-6 border-2 border-t-blue-500 border-b-blue-500 rounded-full animate-spin"></div>
                </div>
            @endif
        </div>
    </div>

</div>
