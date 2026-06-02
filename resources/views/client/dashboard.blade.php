<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joki In - Dashboard Klien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold text-indigo-600 tracking-tight">JOKI IN</h1>

            <div class="hidden md:block flex-1 max-w-xl mx-8">
                <div class="relative">
                    <input type="text" placeholder="Cari game atau jasa (Cth: Genshin, Valorant)..."
                        class="w-full bg-gray-100 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-lg py-2 px-4 text-sm transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex items-center space-x-3">

                <div class="text-right hidden sm:block">
                    <p class="text-xs text-gray-500">Saldo Escrow</p>
                    <p class="text-sm font-bold text-gray-900">Rp 500.000</p>
                </div>

                <div
                    class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold border border-indigo-200">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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

        @if ($activeOrder)
            <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="font-bold text-gray-800">Pesanan Aktif Anda ({{ $activeOrder['game'] }})</h2>
                    <a href="https://www.youtube.com/watch?v=xfuIlmywvXI" class="text-sm text-indigo-600 font-semibold hover:text-indigo-800">Lihat Detail &
                        Live Stream &rarr;</a>
                </div>
                <div class="p-4">
                    @if ($activeOrder['session_locked'])
                        <div class="flex items-start bg-red-50 border border-red-200 rounded-lg p-4 animate-pulse">
                            <svg class="w-6 h-6 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            <div>
                                <h3 class="text-red-800 font-bold">JANGAN BUKA GAME!</h3>
                                <p class="text-sm text-red-700 mt-1">Mitra sedang login dan mengerjakan akun Anda saat
                                    ini. Membuka game dapat memicu sistem Banned dari developer.</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start bg-green-50 border border-green-200 rounded-lg p-4">
                            <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-green-800 font-bold">AKUN AMAN DIAKSES</h3>
                                <p class="text-sm text-green-700 mt-1">Sesi pengerjaan sedang dihentikan sementara. Anda
                                    diizinkan untuk membuka game saat ini.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
            <button id="all-filter"
                class="px-5 py-2 bg-indigo-600 text-white rounded-full text-sm font-medium whitespace-nowrap shadow-sm">
                Semua Jasa
            </button>
            <button id="single-filter"
                class="px-5 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-medium whitespace-nowrap transition-colors">
                Game Single-Player (Gacha)
            </button>
            <button id="comp-filter"
                class="px-5 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-medium whitespace-nowrap transition-colors">
                Game Kompetitif (Mabar)
            </button>
        </div>

        <h2 class="text-xl font-bold text-gray-900 mb-6">Rekomendasi Mitra Joki In</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach ($services as $service)
                <div class="service-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col"
                    data-category="{{ $service['category'] }}">
                    <div
                        class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white relative">
                        <span class="font-bold text-lg opacity-80">{{ $service['game'] }}</span>
                        <span
                            class="absolute top-2 right-2 bg-white text-gray-800 text-xs font-bold px-2 py-1 rounded shadow-sm">
                            {{ $service['category'] }}
                        </span>
                    </div>

                    <div class="p-4 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-gray-500 uppercase">{{ $service['mitra_name'] }}</span>
                            <div class="flex items-center text-yellow-500 text-xs font-bold">
                                <svg class="w-3 h-3 mr-1 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                {{ $service['rating'] }} ({{ $service['reviews'] }})
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-900 text-sm mb-2 leading-tight flex-1">{{ $service['title'] }}
                        </h3>

                        <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3">
                            <div>
                                <span class="text-xs text-gray-500 block">Mulai dari</span>
                                <span class="font-bold text-indigo-600">Rp
                                    {{ number_format($service['price'], 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('client.checkout', $service['id']) }}"
                                class="bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-colors">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

    <script>
        const cards = document.querySelectorAll('.service-card');

        const allBtn = document.getElementById('all-filter');
        const singleBtn = document.getElementById('single-filter');
        const compBtn = document.getElementById('comp-filter');

        function setActiveButton(activeBtn) {
            [allBtn, singleBtn, compBtn].forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-600');
            });

            activeBtn.classList.remove('bg-white', 'text-gray-600');
            activeBtn.classList.add('bg-indigo-600', 'text-white');
        }

        allBtn.addEventListener('click', () => {
            setActiveButton(allBtn);

            cards.forEach(card => {
                card.style.display = 'flex';
            });
        });

        singleBtn.addEventListener('click', () => {
            setActiveButton(singleBtn);

            cards.forEach(card => {
                if (card.dataset.category === 'Single-Player') {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        compBtn.addEventListener('click', () => {
            setActiveButton(compBtn);

            cards.forEach(card => {
                if (card.dataset.category === 'Kompetitif') {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
