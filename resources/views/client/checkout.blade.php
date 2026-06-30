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
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-900">Selesaikan Pembayaran</h1>
        </div>
    </nav>

    <main class="container mx-auto mt-8 px-4 max-w-5xl">
        <!-- Tampilan Error Validasi Laravel Umum -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg font-semibold">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('client.checkout.process') }}" method="POST" enctype="multipart/form-data"
            id="checkoutForm">
            @csrf

            <!-- Penyesuaian ke format Object Eloquent ($service->kolom) -->
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="game" value="{{ $service->game }}">
            <input type="hidden" name="mitra_name" value="{{ $service->mitra_name }}">
            <input type="hidden" name="service_name" value="{{ $service->title }}">
            <input type="hidden" name="price" value="{{ $service->price + 5000 }}"> {{-- Otomatis total harga asli + admin --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <h2 class="font-bold text-lg border-b border-gray-100 pb-3 mb-4">Ringkasan Pesanan</h2>

                        <div class="mb-4">
                            <span class="text-xs font-bold text-gray-500 uppercase">{{ $service->game }}</span>
                            <h3 class="text-md font-bold text-gray-900 mt-1">{{ $service->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Dikerjakan oleh: <span
                                    class="font-semibold">{{ $service->mitra_name }}</span></p>
                        </div>

                        <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4 mb-4">
                            <h4 class="text-sm font-bold text-indigo-800 mb-2">Detail Login Akun Game Anda</h4>
                            <div class="space-y-3">
                                <input type="text" name="game_id" placeholder="Email / ID Game" required
                                    class="w-full p-2 border border-indigo-200 rounded text-sm focus:ring-1 focus:ring-indigo-500 outline-none bg-white">
                                <input type="password" name="game_password" placeholder="Password Akun" required
                                    class="w-full p-2 border border-indigo-200 rounded text-sm focus:ring-1 focus:ring-indigo-500 outline-none bg-white">
                                <input type="text" name="game_server" placeholder="Server (Cth: Asia)" required
                                    class="w-full p-2 border border-indigo-200 rounded text-sm focus:ring-1 focus:ring-indigo-500 outline-none bg-white">
                                <p class="text-xs text-indigo-600 font-medium">*Data ini dienkripsi secara aman dan
                                    hanya akan dibuka oleh Mitra saat pengerjaan dimulai.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="font-bold text-lg border-b border-gray-100 pb-3 mb-4">Rincian Pembayaran</h2>
                        <div class="flex justify-between mb-2 text-sm">
                            <span class="text-gray-600">Harga Jasa</span>
                            <span class="font-medium text-gray-900">Rp
                                {{ number_format($service->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-4 text-sm">
                            <span class="text-gray-600">Biaya Layanan & Escrow Joki In</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format(5000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pt-4 border-t border-gray-200 border-dashed">
                            <span class="font-bold text-gray-900">Total Tagihan</span>
                            <span class="font-bold text-indigo-600 text-lg">Rp
                                {{ number_format($service->price + 5000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            <h2 class="font-bold text-lg">Pembayaran Aman (Escrow)</h2>
                        </div>
                        <p class="text-sm text-gray-600 mb-6">Dana Anda akan ditahan oleh sistem Joki In dan baru akan
                            diteruskan ke Mitra setelah akun Anda selesai dikerjakan dengan aman.</p>

                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Transfer ke Rekening Bersama
                            </p>
                            <h3 class="text-xl font-bold text-gray-900">BCA - 0123 4567 89</h3>
                            <p class="text-sm font-medium text-gray-700 mt-1">a.n PT Joki In Ekosistem</p>
                        </div>

                        <!-- Bagian Upload dengan Preview dan Peringatan -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unggah Bukti Transfer</label>

                            <!-- Wadah Peringatan Client-side -->
                            <div id="uploadError"
                                class="hidden mb-3 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-lg font-semibold flex items-center">
                                <svg class="w-4 h-4 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span id="errorText">Ukuran gambar terlalu besar! Maksimal 2MB.</span>
                            </div>

                            <div class="flex flex-col items-center justify-center w-full">
                                <label id="dropzone"
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 p-4 transition-all overflow-hidden relative">

                                    <div id="uploadPlaceholder"
                                        class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                        <svg class="w-8 h-8 mb-2 text-gray-400" id="uploadIcon" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk
                                                unggah</span> atau seret file</p>
                                        <p class="text-xs text-gray-400">PNG, JPG, JPEG (Maks. 2MB)</p>
                                    </div>

                                    <div id="previewContainer"
                                        class="hidden absolute inset-0 w-full h-full bg-white flex items-center justify-center p-2 group">
                                        <img id="imagePreview" src="#" alt="Preview Bukti Transfer"
                                            class="w-full h-full object-contain rounded-lg">
                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span
                                                class="text-white text-xs font-semibold bg-gray-900/80 px-3 py-1.5 rounded-full">Ganti
                                                Gambar</span>
                                        </div>
                                    </div>

                                    <input type="file" name="payment_receipt" id="payment_receipt" class="hidden"
                                        accept="image/png, image/jpeg, image/jpg" required />
                                </label>
                            </div>
                        </div>

                        <div class="flex items-start mb-6">
                            <div class="flex items-center h-5">
                                <input type="checkbox" required
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-indigo-300">
                            </div>
                            <label class="ml-2 text-sm font-medium text-gray-900">
                                Saya menyetujui <a href="#" class="text-indigo-600 hover:underline">Syarat &
                                    Ketentuan</a>. Saya sadar bahwa risiko sanksi in-game adalah tanggung jawab pribadi.
                            </label>
                        </div>

                        <button type="submit" id="submitBtn"
                            class="w-full text-white bg-indigo-600 hover:bg-indigo-700 font-bold rounded-lg text-md px-5 py-3.5 text-center transition-colors">
                            Kirim Pembayaran & Buat Pesanan
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </main>

    <!-- JavaScript Real-time Validation & Preview -->
    <script>
        const fileInput = document.getElementById('payment_receipt');
        const dropzone = document.getElementById('dropzone');
        const placeholder = document.getElementById('uploadPlaceholder');
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const errorDiv = document.getElementById('uploadError');
        const errorText = document.getElementById('errorText');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('checkoutForm');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];

            if (!file) {
                resetPreview();
                return;
            }

            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                showError("Ukuran gambar terlalu besar! File Anda (" + (file.size / (1024 * 1024)).toFixed(2) +
                    " MB) melebihi batas maksimal 2MB.");
                this.value = "";
                resetPreview();
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                showError("Format berkas tidak didukung! Sila gunakan format PNG, JPG, atau JPEG.");
                this.value = "";
                resetPreview();
                return;
            }

            hideError();

            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                dropzone.classList.remove('border-gray-300', 'border-red-400');
                dropzone.classList.add('border-green-400');
            }
            reader.readAsDataURL(file);
        });

        form.addEventListener('submit', function(e) {
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                showError("Peringatan! Anda wajib mengunggah bukti transfer sebelum melanjutkan pesanan.");
                dropzone.classList.add('border-red-400');
                dropzone.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        function showError(message) {
            errorText.textContent = message;
            errorDiv.classList.remove('hidden');
            dropzone.classList.remove('border-gray-300', 'border-green-400');
            dropzone.classList.add('border-red-400', 'bg-red-50');
        }

        function hideError() {
            errorDiv.classList.add('hidden');
            dropzone.classList.remove('bg-red-50');
        }

        function resetPreview() {
            imagePreview.src = "#";
            previewContainer.classList.add('hidden');
            placeholder.classList.remove('hidden');
            dropzone.classList.remove('border-green-400', 'border-red-400');
            dropzone.classList.add('border-gray-300');
        }
    </script>

</body>

</html>
