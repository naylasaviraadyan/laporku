<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100 relative overflow-hidden
    md:max-w-7xl md:mx-auto md:px-6">

        <!-- 🔷 HEADER (tanpa tombol back) -->
        <div class="bg-blue-600 text-white p-4">
            <h1 class="font-semibold text-lg">Notifikasi</h1>
        </div>

        <!-- 📄 LIST -->
        <div class="p-4 space-y-3">

            @forelse($notifications as $notif)

            <div class="bg-white p-4 rounded-xl shadow relative">

                <div>
                    <p class="font-semibold text-sm">
                        {{ $notif->title }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ $notif->message }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $notif->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            @empty
            <div class="text-center text-gray-400 text-sm mt-10">
                Belum ada notifikasi
            </div>
            @endforelse

        </div>

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

            <a href="{{ route('notifikasi') }}" class="flex flex-col items-center text-blue-600">
                <span>🔔</span>
                <span class="text-xs">Notifikasi</span>
            </a>

            <a href="{{ route('profil') }}" class="flex flex-col items-center text-gray-400">
                <span>👤</span>
                <span class="text-xs">Profil</span>
            </a>

        </div>

    </div>

</body>

</html>