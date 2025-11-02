<div>
    <x-notifAlert />

    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <x-dashboard.breadcrumb title="Dashboard" />

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-dashboard.start-card title="Total Barang" :value="$totalProducts" icon="fas fa-box-open"
                color="text-yellow-500" />
            <x-dashboard.start-card title="Total Pelanggan" :value="$totalUsers" icon="fas fa-users" color="text-green-600" />
            <x-dashboard.start-card title="Total Order" :value="$totalOrders" icon="fas fa-shopping-cart"
                color="text-blue-600" />

            {{-- <x-dashboard.start-card title="Total Pemasukan" value="0" icon="fas fa-shopping-ca" color="text-blue-600"/> --}}
        </div>

        <div class="flex flex-col md:flex-row gap-5 mt-4 w-full">
            {{-- CHART SECTION (sementara dikomentari) --}}
            <div class="w-full lg:w-1/2 flex flex-col lg:flex-row gap-4" wire:ignore>
                <div class="bg-white rounded-2xl shadow p-4 flex-1">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Chart Harian</h3>
                    <canvas id="orderChart" class="w-full h-full"></canvas>
                </div>
            </div>

            {{-- PRODUCT STOCK SECTION --}}
            <div class="w-full lg:w-1/2 bg-white rounded-2xl shadow p-4 overflow-x-auto">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4">Stock Barang</h3>
                    <a href="{{ route('dashboard.products.index') }}"
                        class="text-lg sm:text-sm font-semibold text-primary mb-4" wire:navigate>Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <x-dashboard.table.table>
                        <x-dashboard.table.tableThead>
                            <x-dashboard.table.headField name="Nama Barang" />
                            <x-dashboard.table.headField name="Stock" />
                            <x-dashboard.table.headField name="Status" />
                            <x-dashboard.table.headField name="Status Stock" />
                        </x-dashboard.table.tableThead>

                        <x-dashboard.table.tableTbody>
                            @forelse ($stockProducts as $product)
                                <tr>
                                    <x-dashboard.table.row
                                        class="w-100 p-3">{{ Str::words($product->title, '3', '...') }}</x-dashboard.table.row>
                                    <x-dashboard.table.row
                                        class="w-30 p-3">{{ $product->stock }}</x-dashboard.table.row>
                                    <x-dashboard.table.row class="w-30 p-3">
                                        @if ($product->status == 'publish')
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">publish</span>
                                        @endif
                                    </x-dashboard.table.row>

                                    <x-dashboard.table.row>
                                        @if ($product->stock >= 1)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Tersedia</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Habis</span>
                                        @endif
                                    </x-dashboard.table.row>

                                    <x-dashboard.table.aksiTable :data="$product">
                                        <form class="p-4 space-y-4" wire:submit="updateStock({{ $product->id }})">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                                                    Stok</label>
                                                <input type="number" wire:model="stock" min="0"
                                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Masukkan jumlah stok">
                                                @error('stock')
                                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Footer -->
                                            <div class="flex justify-end gap-2 pt-2 border-t">
                                                <button type="button" @click="openModal= false"
                                                    class="px-3 py-2 text-sm bg-gray-200 rounded-lg hover:bg-gray-300">
                                                    Batal
                                                </button>
                                                <button type="submit" wire:loading.attr='false'
                                                    class="px-3 py-2 text-sm bg-primary text-white rounded-lg hover:bg-slate-700">
                                                    Simpan
                                                    <div role="status" wire:loading wire:target="updateStock">
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
                                    <x-dashboard.table.row colspan="4">
                                        <p class="text-center font-semibold text-slate-400">Tidak ada data</p>
                                    </x-dashboard.table.row>
                                </tr>
                            @endforelse
                        </x-dashboard.table.tableTbody>
                    </x-dashboard.table.table>
                </div>
            </div>
        </div>

        {{-- PRODUCT USER ORDER --}}
        <div class="w-full mt-4 bg-white rounded-2xl shadow p-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-1">Order Terbaru</h3>
                <a href="{{ route('dashboard.products.index') }}"
                    class="text-lg sm:text-sm font-semibold text-primary mb-4" wire:navigate>Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                @forelse ($orders as $code => $items)
                    <div class="my-4">
                        <p class="text-heading text-slate-800 text-sm">Code Order: <span
                                class="font-bold">{{ $code }}</span></p>
                        <x-dashboard.table.table>
                            <x-dashboard.table.tableThead :action="false">
                                <x-dashboard.table.headField name="Nama Barang" />
                                <x-dashboard.table.headField name="Jumlah" />
                                <x-dashboard.table.headField name="Harga" />
                                <x-dashboard.table.headField name="Total Harga" />
                                <x-dashboard.table.headField name="Status Order" />
                                <x-dashboard.table.headField name="Kode Order" />
                                <x-dashboard.table.headField name="Tangal" />
                            </x-dashboard.table.tableThead>

                            <x-dashboard.table.tableTbody>
                                @foreach ($items as $order)
                                    <tr>
                                        <x-dashboard.table.row>{{ Str::words($order->product->title, '3', '...') }}</x-dashboard.table.row>
                                        <x-dashboard.table.row
                                            class="w-30 p-3">{{ $order->qty }}x</x-dashboard.table.row>
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
                    </div>
                @empty
                    <p class="text-center font-semibold text-slate-400">Tidak ada data</p>
                @endforelse

            </div>
        </div>
    </div>

    @script
        <script>
            console.log(@json($chartOrders));

            const ctx = document.getElementById('orderChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels), //data dari labels livewire
                    datasets: [{
                        label: 'Pembelian Perhari',
                        data: @json($chartOrders),
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            onClick: (e) => e.stopPropagation(),
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // 🟢 Tampilkan hanya bilangan bulat
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                },
                                stepSize: 1,
                            }
                        }
                    }
                },
            });
        </script>
    @endscript
</div>
