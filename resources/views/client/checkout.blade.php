<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pembayaran - Joki In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 pb-12">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center">
            <a href="{{ route('client.dashboard') }}" class="text-gray-500 hover:text-indigo-600 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-gray-900">Selesaikan Pembayaran</h1>
        </div>
    </nav>

    <main class="container mx-auto mt-8 px-4 max-w-5xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="font-bold text-lg border-b border-gray-100 pb-3 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="mb-4">
                        <span class="text-xs font-bold text-gray-500 uppercase">{{ $orderDetail['game'] }}</span>
                        <h3 class="text-md font-bold text-gray-900 mt-1">{{ $orderDetail['service_title'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Dikerjakan oleh: <span class="font-semibold">{{ $orderDetail['mitra_name'] }}</span></p>
                    </div>

                    <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4 mb-4">
                        <h4 class="text-sm font-bold text-indigo-800 mb-2">Detail Login Akun Game Anda</h4>
                        <div class="space-y-3">
                            <input type="text" placeholder="Email / ID Game" class="w-full p-2 border border-indigo-200 rounded text-sm focus:ring-indigo-500">
                            <input type="password" placeholder="Password Akun" class="w-full p-2 border border-indigo-200 rounded text-sm focus:ring-indigo-500">
                            <input type="text" placeholder="Server (Cth: Asia)" class="w-full p-2 border border-indigo-200 rounded text-sm focus:ring-indigo-500">
                            <p class="text-xs text-indigo-600 font-medium">*Data ini dienkripsi secara end-to-end dan hanya akan dibuka oleh Mitra saat pengerjaan.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="font-bold text-lg border-b border-gray-100 pb-3 mb-4">Rincian Pembayaran</h2>
                    <div class="flex justify-between mb-2 text-sm">
                        <span class="text-gray-600">Harga Jasa</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($orderDetail['base_price'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-4 text-sm">
                        <span class="text-gray-600">Biaya Layanan & Escrow Joki In</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($orderDetail['platform_fee'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between pt-4 border-t border-gray-200 border-dashed">
                        <span class="font-bold text-gray-900">Total Tagihan</span>
                        <span class="font-bold text-indigo-600 text-lg">Rp {{ number_format($orderDetail['total_price'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div>
                <form action="{{ route('client.checkout.process') }}" method="POST">
                    @csrf
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <h2 class="font-bold text-lg">Pembayaran Aman (Escrow)</h2>
                        </div>
                        <p class="text-sm text-gray-600 mb-6">Dana Anda akan ditahan oleh sistem Joki In dan baru akan diteruskan ke Mitra setelah akun Anda selesai dikerjakan dengan aman.</p>

                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Transfer ke Rekening Bersama</p>
                            <h3 class="text-xl font-bold text-gray-900">BCA - 0123 4567 89</h3>
                            <p class="text-sm font-medium text-gray-700 mt-1">a.n PT Joki In Ekosistem</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unggah Bukti Transfer</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk unggah</span> atau drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                                    </div>
                                    <input type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>

                        <div class="flex items-start mb-6">
                            <div class="flex items-center h-5">
                                <input type="checkbox" required class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-indigo-300">
                            </div>
                            <label class="ml-2 text-sm font-medium text-gray-900">
                                Saya menyetujui <a href="#" class="text-indigo-600 hover:underline">Syarat & Ketentuan</a>. Saya sadar bahwa risiko sanksi in-game adalah tanggung jawab pribadi.
                            </label>
                        </div>

                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 font-bold rounded-lg text-md px-5 py-3.5 text-center transition-colors">
                            Kirim Pembayaran & Buat Pesanan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

</body>
</html>