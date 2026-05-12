<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Joki In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 flex items-center justify-center min-h-screen py-10">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden p-8 border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-indigo-600 tracking-tight">JOKI IN</h1>
            <p class="text-sm text-gray-500 mt-2">Buat akun untuk mulai menggunakan layanan kami.</p>
        </div>

        <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" placeholder="John Doe" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="nama@email.com" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
            </div>

            <div class="pt-2">
                <label class="block text-sm font-medium text-gray-700 mb-3">Mendaftar Sebagai:</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative border border-gray-300 rounded-lg p-4 flex cursor-pointer hover:bg-indigo-50 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                        <input type="radio" name="role" value="client" class="peer sr-only" checked>
                        <div class="text-sm">
                            <span class="font-bold text-gray-900 block mb-1">Klien Pengguna</span>
                            <span class="text-gray-500 text-xs">Saya ingin mencari jasa Joki atau teman Mabar.</span>
                        </div>
                        <svg class="w-5 h-5 text-indigo-600 absolute top-4 right-4 hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </label>

                    <label class="relative border border-gray-300 rounded-lg p-4 flex cursor-pointer hover:bg-indigo-50 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                        <input type="radio" name="role" value="mitra" class="peer sr-only">
                        <div class="text-sm">
                            <span class="font-bold text-gray-900 block mb-1">Mitra Joki In</span>
                            <span class="text-gray-500 text-xs">Saya ingin menawarkan jasa keahlian bermain game.</span>
                        </div>
                        <svg class="w-5 h-5 text-indigo-600 absolute top-4 right-4 hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 mt-4">
                Buat Akun
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-8">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Masuk di sini</a>
        </p>
    </div>

</body>
</html>