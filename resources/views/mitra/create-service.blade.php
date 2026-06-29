<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joki In - Tambah Jasa Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <div class="container mx-auto max-w-2xl mt-10 px-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 bg-indigo-600 text-white">
                <h2 class="text-xl font-bold">Buat Layanan Jasa Joki Baru</h2>
                <p class="text-indigo-200 text-sm mt-1">Isi detail kemampuan dan paket joki yang ingin kamu tawarkan
                    kepada klien.</p>
            </div>

            <form action="{{ route('mitra.service.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Game</label>
                    <input type="text" name="game" placeholder="Contoh: Mobile Legends, Genshin Impact" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori Game</label>
                    <select name="category" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="Kompetitif">Kompetitif (Mabar / Push Rank)</option>
                        <option value="Single-Player">Single-Player (Gacha / Eksplorasi / Quest)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Layanan / Paket Jasa</label>
                    <input type="text" name="title" placeholder="Contoh: Joki Gendong Ultimate Epic ke Mythic"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Jasa (Rp)</label>
                    <input type="number" name="price" placeholder="Contoh: 150000" min="1000" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('mitra.dashboard') }}"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                        Simpan Jasa
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
