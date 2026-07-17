<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joki In - Detail Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">
    <nav class="bg-indigo-600 text-white p-4 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wider">
                JOKI IN <span class="text-indigo-200 text-sm font-normal">| Detail Order Panel</span>
            </h1>
            <div class="flex items-center space-x-3">
                <span class="text-sm font-medium hidden sm:inline">{{ Auth::user()->name }}</span>
                <div
                    class="w-8 h-8 bg-indigo-400 rounded-full flex items-center justify-center font-bold text-sm shadow-inner uppercase">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4 max-w-3xl mb-12">
        @if (session('success'))
            <div
                class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl font-semibold flex items-center shadow-sm">
                <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                <div>
                    <span
                        class="text-xs font-mono bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md border border-gray-200">
                        {{ $order->order_code }}
                    </span>
                    <h2 class="text-2xl font-black mt-3 text-gray-900 tracking-tight">
                        {{ $order->game }}
                    </h2>
                    <p class="text-gray-500 text-sm mt-0.5 font-medium">
                        {{ $order->service_name }}
                    </p>
                </div>

                <div>
                    @if ($order->status == 'Sedang Dikerjakan')
                        <span
                            class="bg-green-100 text-green-700 border border-green-200 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider inline-block">
                            {{ $order->status }}
                        </span>
                    @elseif ($order->status == 'Menunggu Dikerjakan')
                        <span
                            class="bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider inline-block">
                            {{ $order->status }}
                        </span>
                    @else
                        <span
                            class="bg-blue-100 text-blue-700 border border-blue-200 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider inline-block">
                            {{ $order->status }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-100">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Client</p>
                    <p class="font-bold text-lg text-gray-800 mt-0.5 truncate">{{ $order->client }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Harga Jasa</p>
                    <p class="font-black text-lg text-indigo-600 mt-0.5">
                        Rp {{ number_format($order->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <h4 class="font-bold text-gray-800 text-base mb-4 flex items-center">
                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                    </path>
                </svg>
                Data Kredensial Akun Game
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                <div>
                    <span class="text-xs text-gray-400 block font-medium">ID / Username</span>
                    <span class="font-semibold text-gray-800 text-sm select-all">{{ $order->game_id }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block font-medium">Server</span>
                    <span class="font-semibold text-gray-800 text-sm">{{ $order->game_server }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block font-medium">Password</span>
                    @if (Auth::user()->role == 'mitra')
                        <span class="font-semibold text-red-600 text-sm select-all">{{ $order->game_password }}</span>
                    @else
                        <span class="font-mono text-gray-400 text-sm">•••••••• (Hanya Terbuka untuk Mitra)</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

            @if (Auth::user()->role == 'mitra')
                <h4 class="font-bold text-gray-800 text-base mb-4">Sistem Keamanan Sesi (Anti-Banned)</h4>

                @if ($order->session_status == 'unlocked')
                    <div class="p-4 bg-green-50 border border-green-200 rounded-xl mb-5 flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 11V7a4 4 0 118 0m-4 10v2m-6-4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-sm text-green-800">
                            <strong>Sesi Terbuka.</strong> Client diizinkan mengakses game. Status pesanan saat ini
                            masih <span class="font-semibold">"Menunggu Dikerjakan"</span>. Silakan kunci akun jika
                            ingin mulai bermain.
                        </p>
                    </div>

                    <form action="{{ route('mitra.session.toggle') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="mb-4">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wide block mb-1.5">Tautan
                                Live Stream Pengerjaan</label>
                            <input type="url" name="stream_url" placeholder="https://youtube.com/live/..." required
                                class="w-full p-3 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm">
                            Mulai Sesi Pengerjaan & Kunci Akun Client
                        </button>
                    </form>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5 flex items-start">
                        <svg class="w-5 h-5 text-red-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m0-8v3m5.243-4.243a8 8 0 11-11.314 0 8 8 0 0111.314 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-bold text-red-800 text-sm">SESI SEDANG TERKUNCI</h3>
                            <p class="text-xs text-red-700 mt-1">Status order otomatis berubah menjadi <span
                                    class="font-semibold">"Sedang Dikerjakan"</span>. Klien telah diberi peringatan di
                                dashboard mereka untuk tidak menabrak login game.</p>
                        </div>
                    </div>

                    <form action="{{ route('mitra.session.toggle') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit"
                            class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm">
                            Akhiri Sesi Pengerjaan (Buka Sesi Akun)
                        </button>
                    </form>
                @endif

                @if ($order->status == 'Sedang Dikerjakan')
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <p class="text-xs text-gray-400 font-medium mb-2.5">Jika Anda sudah menyelesaikan seluruh target
                            joki, tandai pesanan ini agar Klien melakukan konfirmasi.</p>
                        <form action="{{ route('mitra.order.finish') }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin tugas joki telah selesai? Sistem akan memberitahu Klien untuk melepas dana escrow.')">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <button type="submit"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition-colors shadow-sm text-sm text-center block">
                                🔔 Nyatakan Pesanan Selesai (Minta Konfirmasi Client)
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <h4 class="font-bold text-gray-800 text-base mb-4">Status Sesi Keamanan Akun</h4>

                @if ($order->session_status == 'locked')
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4 flex items-start">
                        <svg class="w-6 h-6 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="font-bold text-red-800 text-sm">🚨 PENTING: JANGAN BUKA GAME SEKARANG!</h3>
                            <p class="text-xs text-red-700 mt-1">
                                Mitra joki kami sedang berada di dalam game untuk memproses pesanan Anda. Membuka game
                                dari perangkat Anda secara sengaja dapat memicu tabrakan sesi login (*Double Login*)
                                yang berisiko banned proteksi keamanan game.
                            </p>
                        </div>
                    </div>

                    @if ($order->stream_url)
                        <a href="{{ $order->stream_url }}" target="_blank"
                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-5 py-3 rounded-xl transition-colors shadow mb-4">
                            <span class="mr-2">🎥</span> Tonton Live Stream Pengerjaan Akun
                        </a>
                    @endif
                @else
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4 flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-bold text-green-800 text-sm">✅ AKUN AMAN DIAKSES</h3>
                            <p class="text-xs text-green-700 mt-1">
                                Mitra sedang beristirahat atau belum menjadwalkan pengerjaan jam ini. Anda bebas
                                memainkan game Anda kembali dengan aman sekarang.
                            </p>
                        </div>
                    </div>
                @endif

                @if ($order->status == 'Sedang Dikerjakan' || $order->status == 'Menunggu Konfirmasi Client')
                    <div
                        class="mt-6 pt-6 border-t border-gray-100 bg-amber-50/50 p-4 rounded-xl border border-amber-100">
                        <h5 class="text-sm font-bold text-amber-900 mb-1">Konfirmasi Penyelesaian Pesanan</h5>
                        <p class="text-xs text-amber-700 font-medium mb-3">Apakah seluruh target joki game telah
                            dipenuhi dengan benar oleh Mitra? Tekan tombol di bawah untuk menyelesaikan transaksi secara
                            permanen.</p>
                        <form action="{{ route('client.order.complete') }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan pesanan ini? Saldo jaminan escrow akan diteruskan permanen ke dompet Mitra.')">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition-colors shadow-md text-sm text-center block">
                                ✓ Konfirmasi Selesai & Lepas Saldo Escrow
                            </button>
                        </form>
                    </div>
                @endif
            @endif

        </div>

        <div class="mt-6 text-center sm:text-left">
            @if (Auth::user()->role == 'mitra')
                <a href="{{ route('mitra.dashboard') }}"
                    class="inline-flex items-center text-indigo-600 hover:text-indigo-800 text-sm font-semibold transition-colors">
                    &larr; Kembali ke Dashboard Utama Mitra
                </a>
            @else
                <a href="{{ route('client.dashboard') }}"
                    class="inline-flex items-center text-indigo-600 hover:text-indigo-800 text-sm font-semibold transition-colors">
                    &larr; Kembali ke Dashboard Utama Client
                </a>
            @endif
        </div>
    </main>
</body>

</html>
