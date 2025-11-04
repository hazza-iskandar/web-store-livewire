<div class="h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100 px-6">
    <div class="bg-white shadow-2xl rounded-2xl p-8 md:p-10 max-w-md w-full text-center border-t-4">
        <div class="flex justify-center mb-6">
            <div class="rounded-full flex items-center justify-center">
                <i class="fa-solid fa-circle-check text-green-500 text-5xl"></i>
            </div>
        </div>

        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Pembayaran Berhasil!</h1>
        <p class="text-gray-600 mb-6">
            Terima kasih telah melakukan pembayaran. Pesanan Anda sedang kami proses.
        </p>

        <div class="bg-gray-50 rounded-xl p-4 mb-6 text-sm text-gray-700 border border-gray-200">
            <p class="font-semibold text-gray-800">Kode Pesanan:</p>
            <p class="text-green-700 font-mono text-lg mt-1">{{ ($orderCode->order_code_group ?? $orderCode->order_code) ?? 'ORD-XXXXXX' }}</p>
            <p class="text-green-700 font-mono text-lg mt-1">{!! formatRupiah($totalHarga) !!}</p>
        </div>

        <a href="{{ route('account.order-user') }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition">
           Lihat Pesanan
        </a>

    </div>
</div>
