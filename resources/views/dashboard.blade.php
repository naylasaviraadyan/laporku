<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LAPORKU</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100 relative overflow-hidden
    md:max-w-7xl md:mx-auto md:px-6">

        <!-- 🔷 NAVBAR -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-10 flex justify-between items-center rounded-b-2xl">
            <h1 class="font-bold text-3xl">LAPORKU</h1>

        </div>

        <!-- 👋 GREETING -->
        <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Halo, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Sampaikan keluhan Anda untuk lingkungan yang lebih baik
            </p>
        </div>

        <!-- ➕ BUTTON -->
        <div class="px-4">
            <a href="{{ route('laporan.create') }}" class="block bg-blue-600 text-white py-3 rounded-xl text-center font-semibold shadow">
                + Buat Laporan Baru
            </a>
        </div>

        <!-- 📊 RINGKASAN -->
        <div class="px-4 mt-5">
            <h3 class="text-sm font-semibold text-gray-600 mb-2">Ringkasan Laporan</h3>

            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white p-3 rounded-xl shadow text-center">
                    <p class="text-lg font-bold text-blue-600">{{ $total }}</p>
                    <p class="text-xs text-gray-500">Total</p>
                </div>

                <div class="bg-white p-3 rounded-xl shadow text-center">
                    <p class="text-lg font-bold text-yellow-500">{{ $proses }}</p>
                    <p class="text-xs text-gray-500">Diproses</p>
                </div>

                <div class="bg-white p-3 rounded-xl shadow text-center">
                    <p class="text-lg font-bold text-green-500">{{ $selesai }}</p>
                    <p class="text-xs text-gray-500">Selesai</p>
                </div>
            </div>
            <div class="flex justify-between items-center mt-6 w-full">

                <h2 class="text-sm font-semibold text-gray-800">
                    Laporan Terbaru
                </h2>

            </div>
        </div>

        <!-- 📄 LAPORAN TERBARU -->
        @foreach ($latest as $item)

        <a href="{{ route('laporan.show', $item->id) }}?from=dashboard"
            class="bg-white p-4 rounded-xl shadow flex justify-between items-center block">

            <!-- KIRI -->
            <div>
                <p class="font-semibold text-sm">
                    {{ $item->deskripsi }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                </p>
            </div>

            <!-- KANAN STATUS -->
            <span class="
        text-xs px-3 py-1 rounded-full font-medium

        @if(strtolower($item->status) == 'pending') 
            bg-orange-100 text-orange-600
        @elseif(strtolower($item->status) == 'selesai') 
            bg-green-100 text-green-600
        @elseif(strtolower($item->status) == 'dibatalkan') 
            bg-red-100 text-red-600
        @elseif(strtolower($item->status) == 'diproses') 
            bg-blue-100 text-blue-600
        @else 
            bg-gray-100 text-gray-500
        @endif
    ">
                {{ ucfirst($item->status) }}
            </span>

        </a>
        @endforeach

    </div>

    </div>

    <!-- 🔻 BOTTOM NAVBAR -->
    <div class="fixed bottom-4 left-0 right-0 max-w-md mx-auto px-4 z-50">

        <div class="bg-white rounded-2xl shadow-lg flex justify-around py-3">

            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-blue-600">
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

            <a href="{{ route('profil') }}" class="flex flex-col items-center text-gray-400">
                <span>👤</span>
                <span class="text-xs">Profil</span>
            </a>

        </div>

    </div>

</body>

</html>