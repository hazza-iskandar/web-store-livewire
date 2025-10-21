<div>
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <x-dashboard.breadcrumb title="Dashboard" />

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-dashboard.start-card title="Total Barang" value="0" icon="fas fa-box-open" color="text-yellow-500" />
            <x-dashboard.start-card title="Total Pelanggan" value="0" icon="fas fa-users" color="text-green-600" />
            <x-dashboard.start-card title="Total Order" value="0" icon="fas fa-shopping-cart"
                color="text-blue-600" />

            {{-- <x-dashboard.start-card title="Total Pemasukan" value="0" icon="fas fa-shopping-ca" color="text-blue-600"/> --}}
        </div>
        <div class="flex gap-5 mt-4 w-full">
            {{-- CHART SECTION (sementara dikomentari) --}}
            <div class="w-full md:w-1/2 flex flex-col lg:flex-row gap-4">
                <div class="bg-white rounded-2xl shadow p-4 flex-1">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Order Baru</h3>
                    <canvas id="orderChart" class="w-full h-64"></canvas>
                </div>
            </div>

            {{-- PRODUCT STOCK SECTION --}}
            <div class="w-full md:w-1/2 bg-white rounded-2xl shadow p-4">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4">Stock Barang</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm sm:text-base text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 uppercase truncate">
                            <thead class="text-gray-600 capitalize">
                                <th scope="col" class="px-4 py-3">Nama Barang</td>
                                <th scope="col" class="px-4 py-3 text-center">Stock</td>
                                <th scope="col" class="px-4 py-3">status</th>
                                </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50 transition truncate">
                                <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                                <td class="px-4 py-3 text-center">30</td>
                                <td class="px-4 py-3">
                                    <yspan
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Tersedia</yspan>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition truncate">
                                <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                                <td class="px-4 py-3 text-center">30</td>
                                <td class="px-4 py-3">
                                    <yspan
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Tersedia</yspan>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition truncate">
                                <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                                <td class="px-4 py-3 text-center">30</td>
                                <td class="px-4 py-3">
                                    <yspan
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Tersedia</yspan>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition truncate">
                                <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                                <td class="px-4 py-3 text-center">30</td>
                                <td class="px-4 py-3">
                                    <yspan
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Tersedia</yspan>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- PRODUCT USER ORDER --}}
        <div class="w-full mt-4 bg-white rounded-2xl shadow p-4">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4">Order Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm sm:text-base text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 uppercase truncate">
                        <thead class="text-gray-600 capitalize">
                            <th scope="col" class="px-4 py-3">Kode Order</td>
                            <th scope="col" class="px-4 py-3">Nama Pelanggan</td>
                            <th scope="col" class="px-4 py-3 text-center">Total</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50 transition truncate">
                            <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                            <td class="px-4 py-3">Udin</td>
                            <td class="px-4 py-3 text-center">15</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition truncate">
                            <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                            <td class="px-4 py-3">Udin</td>
                            <td class="px-4 py-3 text-center">42</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition truncate">
                            <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                            <td class="px-4 py-3">Udin</td>
                            <td class="px-4 py-3 text-center">42</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition truncate">
                            <td class="px-4 py-3 font-medium">ORD-KPHYLD-745873</td>
                            <td class="px-4 py-3">Udin</td>
                            <td class="px-4 py-3 text-center">9</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
