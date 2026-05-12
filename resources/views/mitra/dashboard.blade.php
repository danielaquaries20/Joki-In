<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joki In - Dashboard Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <nav class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wider">JOKI IN <span class="text-indigo-200 text-sm font-normal">| Mitra Panel</span></h1>
            <div class="flex items-center space-x-4">
                <span class="font-medium">Rp {{ number_format($mockOrder['earnings'], 0, ',', '.') }}</span>
                <div class="w-8 h-8 bg-indigo-400 rounded-full flex items-center justify-center font-bold">M</div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4 max-w-3xl">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6">Pesanan Aktif Anda</h2>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-start">
                <div>
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $mockOrder['order_id'] }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $mockOrder['game'] }}</h3>
                    <p class="text-gray-600 mt-1">{{ $mockOrder['service_name'] }}</p>
                    <p class="text-sm text-gray-500 mt-2">Klien: <span class="font-medium text-gray-800">{{ $mockOrder['client_name'] }}</span></p>
                </div>
            </div>

            <div class="p-6 bg-gray-50">
                <h4 class="font-bold text-gray-700 mb-4">Sistem Keamanan Sesi (Anti-Banned)</h4>
                
                @if($mockOrder['session_status'] == 'unlocked')
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg mb-4">
                        <p class="text-sm text-green-800">
                            <strong>Sesi Terbuka.</strong> Anda sedang tidak login di dalam game. Klien saat ini diizinkan untuk membuka akunnya.
                        </p>
                    </div>
                    
                    <form action="{{ route('mitra.session.toggle') }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <label class="text-sm font-medium text-gray-700">Tautan Live Stream (Wajib)</label>
                        <input type="url" name="stream_url" placeholder="https://youtube.com/live/..." class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 text-sm">
                        
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 mt-2">
                            Mulai Sesi Pengerjaan (Kunci Akun Klien)
                        </button>
                    </form>

                @else
                    <div class="p-4 border-l-4 border-red-500 bg-red-50 rounded-r-lg mb-4 shadow-sm animate-pulse">
                        <div class="flex items-center">
                            <h3 class="text-red-800 font-bold">SESI SEDANG TERKUNCI</h3>
                        </div>
                        <p class="text-sm text-red-700 mt-2">
                            Aplikasi Klien saat ini terkunci dengan layar peringatan untuk mencegah bentrok login.
                        </p>
                    </div>

                    <form action="{{ route('mitra.session.toggle') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                            Akhiri Sesi Pengerjaan (Buka Kunci)
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>
</body>
</html>