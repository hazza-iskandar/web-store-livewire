<div>
    <x-notifAlert />
    <section class="my-4 flex h-full min-h-100">
        <div class="container">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                <x-dashboard.breadcrumb :account="true" :items="[['name' => 'profile']]" />

            </div>

            <div class="flex flex-col lg:flex-row justify-between gap-10 mt-3 sm:mt-10">
                <div class="w-full lg:w-1/5">
                    <h3 class="font-semibold hidden sm:block">Manage My Account</h3>
                    <h3 class="font-semibold sm:hidden block mt-4">My Account</h3>
                    <ul wire:ignore
                        class="ms-0 sm:ms-7 sm:mt-2 flex gap-3 w-full overflow-scroll scrollbar-hide py-3 sm:p-0 sm:block">
                        <x-sidebar-account :href="route('account.profile')" :active="request()->routeIs('account.profile')">
                            Profile
                        </x-sidebar-account>
                        <x-sidebar-account :href="route('account.order-user')" :active="request()->routeIs('account.order-user')">
                            Pesanan
                        </x-sidebar-account>
                    </ul>
                </div>

                <div class="w-full">
                    {{-- Toggle Button --}}
                    <div class="flex shadow-md rounded-xl overflow-hidden text-sm font-medium p-3">
                        <button wire:click="setStatus('pending')"
                            class="{{ $status === 'pending' ? 'status-active' : '' }} flex-1 cursor-pointer px-4 py-2 text-center transition">
                            Pending
                        </button>
                        <button wire:click="setStatus('paid')"
                            class="{{ $status === 'paid' ? 'status-active' : '' }} flex-1 cursor-pointer px-4 py-2 text-center transition">
                            Paid
                        </button>
                        <button wire:click="setStatus('canceled')"
                            class="{{ $status === 'canceled' ? 'status-active' : '' }} flex-1 cursor-pointer px-4 py-2 text-center transition">
                            Canceled
                        </button>
                    </div>
                    <!-- Item -->
                    @forelse ($orders as $groupCode => $groupOrders)
                        <div class="bg-white my-4 shadow-md rounded-2xl p-5 hover:shadow-lg transition">
                            <div class="mb-3">
                                <h3 class="text-lg font-semibold text-gray-700">Kode Pesanan:
                                    {{ $groupCode }}</h3>
                                <p class="text-sm text-gray-500">Tanggal Pesan:
                                    {{ date_format($groupOrders->first()->created_at, 'Y M d') }}</p>
                            </div>

                            @foreach ($groupOrders as $order)
                                <div class="flex items-center justify-between border-b py-2">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ thumbnailCond($order->product->thumbnail) }}" alt="Product"
                                            class="w-16 h-16 object-cover rounded-xl">
                                        <div>
                                            <h4 class="text-base font-semibold text-gray-700">
                                                {{ $order->product->title }}</h4>
                                            <p class="text-sm text-gray-500">{{ $order->qty }}x</p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <span class="text-gray-700 font-semibold">{!! formatRupiah($order->total_price) !!}</span><br>
                                        @if ($order->status == 'paid')
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">{{ $order->status }}</span>
                                        @elseif ($order->status == 'pending')
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-700">{{ $order->status }}</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">{{ $order->status }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="flex gap-2 justify-end items-center my-3" x-data="{ openDeleteModal: false }">

                                <button type="button"
                                    class="text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-3 py-2 text-center">
                                    Bayar Sekarang
                                </button>
                                <button type="button" @click="openDeleteModal= true"
                                    class="text-white bg-red-600 hover:bg-red-700 cursor-pointer font-medium rounded-lg text-sm px-3 py-2 text-center">
                                    Hapus
                                </button>


                                <div class="text-right mt-3 font-bold text-gray-800">
                                    Total: {!! formatRupiah($groupOrders->sum('total_price')) !!}
                                </div>

                                {{-- modal --}}
                                <x-modal2 show="openDeleteModal">
                                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-4xl mb-3"></i>
                                    <h2 class="text-lg font-semibold mb-2">Hapus Data?</h2>
                                    <p class="text-gray-600 mb-4">Apakah kamu yakin ingin menghapus data ini? Tindakan
                                        ini
                                        tidak
                                        dapat
                                        dibatalkan.</p>

                                    <div class="flex justify-center space-x-3">
                                        <button @click="openDeleteModal = false"
                                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                            Batal
                                        </button>
                                        {{-- data dari komponen akan di terima index products --}}
                                        <button
                                            wire:click='deleteOrder("{{ $order->order_code_group ?? $order->order_code }}")'
                                            @click="openDeleteModal = false"
                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </div>
                                </x-modal2>
                            </div>
                        </div>
                    @empty
                        <p class="text-center font-semibold text-lg text-slate-400 mt-2">Belum ada pesanan</p>
                    @endforelse

                    {{-- {{ $orders->links('components.custom-pagination') }} --}}
                </div>
            </div>
        </div>
    </section>
</div>
