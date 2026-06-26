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
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="relative group">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold border border-indigo-200 cursor-pointer">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg p-3 hidden group-hover:block">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-6 px-4 pb-12">
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="text-sm text-gray-500">Total Pesanan</p>
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

        <h2 class="text-xl font-bold mb-6">Daftar Pesanan</h2>

        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <div class="order-card bg-white rounded-xl shadow-sm border p-5 mb-4"
                    data-search="{{ strtolower($order['order_code'] . ' ' . $order['client'] . ' ' . $order['game']) }}">

                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-lg">{{ $order['order_code'] }}</h3>
                            <p class="text-gray-600">Client: {{ $order['client'] }}</p>
                            <p class="text-gray-600 mb-2">Game: {{ $order['game'] }}</p>

                            @if ($order['status'] == 'Sedang Dikerjakan')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $order['status'] }}
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $order['status'] }}
                                </span>
                            @endif
                        </div>

                        <a href="{{ route('mitra.detail', $order['id']) }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-xl border p-8 text-center">
                <h3 class="font-bold text-lg text-gray-700">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mt-2">Pesanan yang masuk akan muncul di sini.</p>
            </div>
        @endif
    </main>

    <script>
        const searchOrder = document.getElementById('search-order');
        const orderCards = document.querySelectorAll('.order-card');

        searchOrder.addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();

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
