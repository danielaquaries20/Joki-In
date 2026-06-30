<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joki In - Dashboard Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">

            <h1 class="text-2xl font-extrabold text-indigo-600 tracking-tight">JOKI IN</h1>

            <div class="hidden md:block flex-1 max-w-xl mx-8">
                <div class="relative">
                    <input id="search-order" type="text" placeholder="Cari Order ID, Client, atau Game..."
                        class="w-full bg-gray-100 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-lg py-2 px-4 text-sm transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="relative group">
                    <div
                        class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold border border-indigo-200 cursor-pointer">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div
                        class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg p-3 hidden group-hover:block z-50">
                        <p class="font-semibold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-sm text-red-600 hover:text-red-800 font-semibold transition-colors">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <main class="container mx-auto mt-6 px-4 pb-12">

        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Total Pesanan Saya</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalOrders }}</h2>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Sedang Dikerjakan</p>
                <h2 class="text-3xl font-bold text-indigo-600 mt-2">{{ $activeOrders }}</h2>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Menunggu Dikerjakan</p>
                <h2 class="text-3xl font-bold text-orange-500 mt-2">{{ $pendingOrders }}</h2>
            </div>
        </div>

        <div class="mb-8">
            <a href="{{ route('mitra.service.create') }}"
                class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Jasa Baru
            </a>
        </div>

        <h2 class="text-xl font-bold mb-4">Daftar Pesanan Jasa Saya</h2>

        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <div class="order-card bg-white rounded-xl shadow-sm border p-5 mb-4 transition-all hover:shadow-md"
                    data-search="{{ strtolower($order['order_code'] . ' ' . $order['client'] . ' ' . $order['game']) }}">

                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 flex-wrap gap-y-2">
                                <h3 class="font-bold text-lg text-indigo-900">{{ $order['order_code'] }}</h3>

                                @if ($order['status'] == 'Sedang Dikerjakan' || $order['status'] == 'processing')
                                    <span
                                        class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                                        Sedang Dikerjakan
                                    </span>
                                @elseif ($order['status'] == 'Menunggu Konfirmasi' || $order['status'] == 'waiting_confirmation')
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                                        Menunggu Konfirmasi Client
                                    </span>
                                @elseif ($order['status'] == 'Selesai' || $order['status'] == 'success')
                                    <span
                                        class="bg-indigo-100 text-indigo-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                                        Selesai & Dicairkan
                                    </span>
                                @else
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                                        {{ $order['status'] }}
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-gray-600 mt-2">Jasa: <span
                                    class="font-semibold text-gray-800">{{ $order['service_title'] ?? $order['service_name'] }}</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Game: <span
                                    class="font-medium text-gray-700">{{ $order['game'] }}</span> | Client: <span
                                    class="font-medium text-gray-700">{{ $order['client'] }}</span></p>
                        </div>
                        <div
                            class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 border-t sm:border-t-0 pt-3 sm:pt-0 border-gray-100">
                            <div class="text-left sm:text-right">
                                <p class="text-xs text-gray-400">Pendapatan Bersih</p>
                                <p class="font-bold text-gray-900 text-md">Rp
                                    {{ number_format($order['mitra_earnings'] ?? $order['price'], 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('mitra.detail', $order->id) }}"
                                class="inline-block bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div class="bg-white rounded-xl border p-12 text-center shadow-sm">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                <h3 class="font-bold text-lg text-gray-700">Belum Ada Pesanan Jasa Anda</h3>
                <p class="text-gray-500 mt-1 text-sm">Pesanan dari client yang membeli jasa buatan Anda akan muncul di
                    sini.</p>
            </div>
        @endif

    </main>

    <script>
        document.getElementById('search-order').addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();
            const orderCards = document.querySelectorAll('.order-card');

            orderCards.forEach(card => {
                const searchable = card.dataset.search;
                if (searchable.includes(keyword)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>
