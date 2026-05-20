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
        <div class="bg-blue-600 text-white p-4 flex items-center gap-3">
            @php $from = request('from'); @endphp

            @if($from == 'dashboard')
            <a href="{{ route('dashboard') }}">←</a>
            @else
            <a href="{{ route('laporan') }}">←</a>
            @endif
            <h1 class="font-semibold text-lg">Detail Laporan</h1>
        </div>

        <!-- 🔥 SCROLL AREA -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 pb-24">

            <!-- STATUS + ID -->
            <div class="flex justify-between items-center">
                @php
                $status = strtolower($report->status);

                $color = match($status) {
                'pending' => 'bg-orange-100 text-orange-600',
                'diproses' => 'bg-blue-100 text-blue-600',
                'selesai' => 'bg-green-100 text-green-600',
                'dibatalkan' => 'bg-red-100 text-red-600',
                default => 'bg-gray-100 text-gray-500'
                };
                @endphp

                <span class="px-3 py-1 text-xs rounded-full {{ $color }}">
                    {{ ucfirst($report->status) }}
                </span>
                <span class="text-xs text-gray-400">
                    #LP{{ str_pad($report->id, 4, '0', STR_PAD_LEFT) }}
                </span>
            </div>

            <h2 class="text-lg font-bold leading-snug">
                {{ $report->deskripsi }}
            </h2>

            <p class="text-xs text-gray-400">
                Dilaporkan pada {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y, H:i') }} <br>
                oleh Anda
            </p>

            <img src="{{ asset('storage/'.$report->foto) }}"
                class="rounded-xl w-full max-h-64 object-cover">

            <div>
                <h3 class="font-semibold text-sm">Deskripsi</h3>
                <p class="text-sm text-gray-600 mt-1">
                    {{ $report->deskripsi }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-sm mb-2">Informasi</h3>

                <div class="space-y-4 text-sm">

                    <!-- KATEGORI -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-gray-500">
                            <span>📁</span>
                            <span>Kategori</span>
                        </div>
                        <span class="font-medium text-gray-700">
                            {{ $report->kategori ?? '-' }}
                        </span>
                    </div>

                    <!-- LOKASI -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-gray-500">
                            <span>📍</span>
                            <span>Lokasi</span>
                        </div>
                        <span class="font-medium text-gray-700">
                            {{ $report->lokasi ?? '-' }}
                        </span>
                    </div>

                    <!-- STATUS -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-gray-500">
                            <span>ℹ️</span>
                            <span>Status</span>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full {{ $color }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>
                    {{-- FOTO BUKTI --}}
                    @if($report->foto_bukti)

                    <div class="mt-6">

                        <p class="text-sm text-gray-400 mb-2">
                            Bukti Pengerjaan
                        </p>

                        <img src="{{ asset('storage/' . $report->foto_bukti) }}"
                            class="w-full rounded-2xl shadow">

                    </div>

                    @endif


                    {{-- CATATAN ADMIN --}}
                    @if($report->catatan_admin)

                    <div class="mt-6">

                        <p class="text-sm text-gray-400 mb-2">
                            Catatan Admin
                        </p>

                        <div class="bg-blue-50 text-blue-700 p-4 rounded-2xl">

                            {{ $report->catatan_admin }}

                        </div>

                    </div>

                    @endif

                </div>
            </div>

        </div>

    </div>

    <!-- 🔥 BUTTON TETAP FIXED -->
    <div class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t p-4">

        <div class="flex gap-2">

            <a href="{{ route('laporan.status', $report->id) }}?from=detail"
                class="flex-1 bg-blue-600 text-white text-center py-3 rounded-xl font-semibold">
                Lihat Status
            </a>
            @if($report->status == 'selesai' && !$report->rating)
            <a href="{{ route('laporan.rating', $report->id) }}"
                class="flex-1 bg-green-600 text-white text-center py-3 rounded-xl font-semibold">
                ⭐ Beri Penilaian
            </a>
            @endif

            @if($report->status == 'pending')
            <form action="{{ route('laporan.batal', $report->id) }}" method="POST">
                @csrf
                <button class="bg-red-500 text-white px-4 rounded-xl text-sm font-semibold">
                    Batal
                </button>
            </form>
            @endif

        </div>

    </div>

</body>

</html>