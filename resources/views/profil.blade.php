<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100 relative overflow-hidden
    md:max-w-7xl md:mx-auto md:px-6">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-black p-6 rounded-b-3xl text-center">
            <img
                src="{{ Auth::user()->foto 
        ? asset('storage/' . Auth::user()->foto) 
        : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                class="w-20 h-20 rounded-full mx-auto object-cover">

            <h2 class="mt-4 text-xl font-semibold">{{ Auth::user()->name }}</h2>
            <p class="text-sm opacity-80">{{ Auth::user()->email }}</p>
        </div>

        <!-- STATS -->
        <div class="bg-white rounded-2xl shadow-md p-4 flex justify-between text-center">

            <div>
                <p class="text-blue-600 font-bold text-lg">
                    {{ $total }}
                </p>
                <p class="text-xs text-gray-500">Total</p>
            </div>

            <div>
                <p class="text-yellow-500 font-bold text-lg">
                    {{ $proses }}
                </p>
                <p class="text-xs text-gray-500">Proses</p>
            </div>

            <div>
                <p class="text-green-500 font-bold text-lg">
                    {{ $selesai }}
                </p>
                <p class="text-xs text-gray-500">Selesai</p>
            </div>

        </div>

        <!-- ⚙️ MENU -->
        <div class="px-4 mt-5 space-y-3">

            <!-- EDIT PROFIL -->
            <a href="{{ route('profil.edit') }}"
                class="bg-white p-4 rounded-xl shadow flex justify-between items-center block hover:bg-gray-50">

                <span>✏️ Edit Profil</span>
                <span>›</span>
            </a>

            <!-- TENTANG -->
            <a href="{{ route('tentang') }}"
                class="bg-white p-4 rounded-xl shadow flex justify-between items-center block hover:bg-gray-50">

                <span>ℹ️ Tentang Aplikasi</span>
                <span>›</span>
            </a>

        </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 text-white py-3 rounded-xl shadow-md">
                Logout
            </button>
        </form>

    </div>

    <!-- 🔻 BOTTOM NAVBAR -->
    <div class="fixed bottom-4 left-0 right-0 max-w-md mx-auto px-4 z-50">

        <div class="bg-white rounded-2xl shadow-lg flex justify-around py-3">

            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-gray-400">
                <span>🏠</span>
                <span class="text-xs">Beranda</span>
            </a>

            <a href="{{ route('laporan') }}" class="flex flex-col items-center text-gray-400">
                <span>📄</span>
                <span class="text-xs">Laporan</span>
            </a>

            <a href="{{ route('notifikasi') }}" class="flex flex-col items-center text-gray-400">
                <span>🔔</span>
                <span class="text-xs">Notifikasi</span>
            </a>

            <a href="{{ route('profil') }}" class="flex flex-col items-center text-blue-600">
                <span>👤</span>
                <span class="text-xs">Profil</span>
            </a>

        </div>

    </div>
</body>

</html>