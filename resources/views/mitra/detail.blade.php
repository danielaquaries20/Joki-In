<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joki In - Detail Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <nav class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wider">
                JOKI IN <span class="text-indigo-200 text-sm font-normal">| Detail Order Panel</span>
            </h1>
            <div class="flex items-center space-x-4">
                <span>{{ Auth::user()->name }}</span>
                <div class="w-8 h-8 bg-indigo-400 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4 max-w-3xl">

        <div class="p-6 bg-white rounded-xl shadow-sm border mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                <div>
                    <span class="text-xs font-mono bg-gray-100 text-gray-600 px-2 py-1 rounded">
                        {{ $order->order_code }}
                    </span>
                    <h2 class="text-2xl font-bold mt-2 text-gray-900">
                        {{ $order->game }}
                    </h2>
                    <p class="text-gray-600 mt-1">
                        {{ $order->service_name }}
                    </p>
                </div>

                <div>
                    @if ($order->status == 'Sedang Dikerjakan')
                        <span
                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold inline-block">
                            {{ $order->status }}
                        </span>
                    @else
                        <span
                            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold inline-block">
                            {{ $order->status }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-100">
                <div>
                    <p class="text-sm text-gray-500">Nama Client</p>
                    <p class="font-semibold text-lg text-gray-800">{{ $order->client }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Harga Jasa</p>
                    <p class="font-semibold text-lg text-indigo-600">
                        Rp {{ number_format($order->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-sm border">

            @if (Auth::user()->role == 'mitra')
                <h4 class="font-bold text-gray-700 mb-4">Sistem Keamanan Sesi (Anti-Banned)</h4>

                @if ($order->session_status == 'unlocked')
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg mb-4">
                        <p class="text-sm text-green-800">
                            <strong>Sesi Terbuka.</strong> Client masih boleh membuka game.
                        </p>
                    </div>

                    <form action="{{ route('mitra.session.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-700 block mb-1">Tautan Live Stream</label>
                            <input type="url" name="stream_url" placeholder="https://youtube.com/live/..." required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition-colors shadow">
                            Mulai Sesi Pengerjaan
                        </button>
                    </form>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4 animate-pulse">
                        <h3 class="font-bold text-red-800">SESI SEDANG TERKUNCI</h3>
                        <p class="text-sm text-red-700 mt-1">Client tidak dapat membuka game saat ini.</p>
                    </div>

                    <form action="{{ route('mitra.session.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit"
                            class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 rounded-lg transition-colors shadow">
                            Akhiri Sesi Pengerjaan
                        </button>
                    </form>
                @endif
            @else
                <h4 class="font-bold text-gray-700 mb-4">Status Sesi Akun Anda</h4>

                @if ($order->session_status == 'locked')
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h3 class="font-bold text-red-800">⚠️ JANGAN BUKA GAME</h3>
                        <p class="text-sm text-red-700 mt-1">Mitra sedang mengerjakan akun Anda saat ini untuk mencegah
                            tumpang tindih sesi (Tabrakan Login).</p>
                    </div>

                    @if ($order->stream_url)
                        <a href="{{ $order->stream_url }}" target="_blank"
                            class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-semibold transition-colors shadow">
                            🎥 Tonton Live Stream Pengerjaan
                        </a>
                    @endif
                @else
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h3 class="font-bold text-green-800">✅ AKUN AMAN DIAKSES</h3>
                        <p class="text-sm text-green-700 mt-1">Mitra sedang beristirahat atau belum memulai pengerjaan.
                            Anda aman masuk ke dalam game.</p>
                    </div>
                @endif
            @endif

        </div>

        <div class="mt-6 text-center sm:text-left">
            @if (Auth::user()->role == 'mitra')
                <a href="{{ route('mitra.dashboard') }}"
                    class="inline-block text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                    &larr; Kembali ke Dashboard Mitra
                </a>
            @else
                <a href="{{ route('client.dashboard') }}"
                    class="inline-block text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                    &larr; Kembali ke Dashboard Client
                </a>
            @endif
        </div>
    </main>

</body>

</html>
