<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100 relative overflow-hidden
    md:max-w-7xl md:mx-auto md:px-6">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-black p-6 rounded-b-3xl shadow-lg">
            <h1 class="text-2xl font-bold text-center">Laporan Saya</h1>
            <p class="text-sm text-center opacity-80 mt-1">Pantau semua laporan Anda</p>
        </div>
        <div class="bg-white px-4 pt-3">
            @php
            $active = request('status');
            @endphp

            @php
            $active = request('status');
            @endphp

            <div class="flex text-sm font-semibold border-b">

                <a href="{{ route('laporan') }}"
                    class="flex-1 text-center pb-2
            {{ !$active ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-400' }}">
                    Semua
                </a>

                <a href="{{ route('laporan', ['status' => 'pending']) }}"
                    class="flex-1 text-center pb-2
            {{ $active == 'pending' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-400' }}">
                    Pending
                </a>

                <a href="{{ route('laporan', ['status' => 'diproses']) }}"
                    class="flex-1 text-center pb-2
            {{ $active == 'diproses' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-400' }}">
                    Diproses
                </a>

                <a href="{{ route('laporan', ['status' => 'selesai']) }}"
                    class="flex-1 text-center pb-2
            {{ $active == 'selesai' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-400' }}">
                    Selesai
                </a>
                <a href="{{ route('laporan', ['status' => 'ditolak']) }}"
                    class="pb-2 px-2 {{ request('status') == 'ditolak' ? 'text-red-500 border-b-2 border-red-500 font-semibold' : 'text-gray-400' }}">
                    Ditolak
                </a>

                <a href="{{ route('laporan', ['status' => 'dibatalkan']) }}"
                    class="flex-1 text-center pb-2
            {{ $active == 'dibatalkan' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-400' }}">
                    Batal
                </a>

            </div>



        </div>

        <!-- LIST -->
        <div class="px-4 pb-28 space-y-4">
            @if($reports->isEmpty())
            <div class="flex flex-col items-center justify-center mt-16 text-center text-gray-400">

                <p class="text-sm font-medium">
                    Tidak ada laporan
                </p>

                @if(request('status'))
                <p class="text-xs mt-1">
                    untuk status "{{ ucfirst(request('status')) }}"
                </p>
                @endif

            </div>
            @endif

            @foreach($reports as $item)

            <a href="{{ route('laporan.show', $item->id) }}"
                class="bg-white p-4 rounded-xl shadow flex gap-3 items-center block hover:shadow-lg transition">

                <!-- GAMBAR -->
                <img src="{{ asset('storage/' . $item->foto) }}"
                    class="w-16 h-16 rounded-lg object-cover">

                <!-- TEXT -->
                <div class="flex-1">
                    <p class="font-semibold text-sm">
                        {{ $item->deskripsi }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                    </p>
                </div>

                <!-- STATUS -->
                <span class="text-xs px-3 py-1 rounded-full
        @if($item->status == 'pending') bg-orange-100 text-orange-600
        @elseif($item->status == 'diproses') bg-blue-100 text-blue-600
        @elseif($item->status == 'selesai') bg-green-100 text-green-600
        @elseif($item->status == 'ditolak') bg-red-100 text-red-600
        @elseif($item->status == 'dibatalkan') bg-red-100 text-red-600
        @endif">
                    {{ ucfirst($item->status) }}
                </span>

            </a>

            @endforeach

        </div>

    </div>
    <!-- 🔻 BOTTOM NAVBAR -->
    <div class="fixed bottom-4 left-0 right-0 max-w-md mx-auto px-4 z-50">

        <div class="bg-white rounded-2xl shadow-lg flex justify-around py-3">

            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-gray-400">
                <span>🏠</span>
                <span class="text-xs">Beranda</span>
            </a>

            <a href="{{ route('laporan') }}" class="flex flex-col items-center text-blue-600">
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