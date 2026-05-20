<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORKU</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white w-80 rounded-3xl shadow-xl p-6 text-center">

        <!-- Icon -->
        <div class="bg-blue-600 w-16 h-16 mx-auto rounded-2xl flex items-center justify-center">
            <span class="text-white text-2xl font-bold">!</span>
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-blue-600 mt-4">LAPORKU</h1>
        <p class="text-gray-500 text-sm mt-1">
            Pengaduan Sarana dan Prasarana
        </p>

        <!-- Ilustrasi (fake tapi mirip vibe) -->
        <div class="mt-6 bg-gradient-to-t from-blue-200 to-blue-100 rounded-xl h-36 relative overflow-hidden">

            <!-- Kota -->
            <svg class="absolute bottom-0 w-full" viewBox="0 0 300 100" fill="none">
                <rect x="10" y="40" width="30" height="60" fill="#93C5FD" />
                <rect x="50" y="30" width="40" height="70" fill="#60A5FA" />
                <rect x="100" y="50" width="30" height="50" fill="#93C5FD" />
                <rect x="140" y="20" width="50" height="80" fill="#3B82F6" />
                <rect x="200" y="35" width="40" height="65" fill="#60A5FA" />
            </svg>

            <!-- Pohon kiri -->
            <div class="absolute bottom-0 left-4">
                <div class="w-8 h-8 bg-green-400 rounded-full"></div>
                <div class="w-1 h-3 bg-green-600 mx-auto"></div>
            </div>

            <!-- Pohon kanan -->
            <div class="absolute bottom-0 right-4">
                <div class="w-8 h-8 bg-green-400 rounded-full"></div>
                <div class="w-1 h-3 bg-green-600 mx-auto"></div>
            </div>

        </div>

        <!-- Button -->
        <div class="mt-6 space-y-3">
            <a href="{{ route('login') }}"
                class="block bg-blue-600 text-white py-2 rounded-full font-semibold">
                Masuk
            </a>

            <a href="{{ route('register') }}"
                class="block border border-blue-600 text-blue-600 py-2 rounded-full font-semibold">
                Daftar
            </a>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 mt-6">© 2026 LAPORKU</p>

    </div>

</body>

</html>