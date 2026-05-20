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
            <a href="{{ route('laporan.show', $report->id) }}?from=dashboard">←</a>
            <h1 class="font-semibold text-lg">Status Laporan</h1>
        </div>

        <!-- CARD -->
        <div class="p-4">
            <div class="bg-white p-3 rounded-xl shadow flex items-center gap-3">
                <img src="{{ asset('storage/'.$report->foto) }}"
                    class="w-14 h-14 rounded-lg object-cover">

                <div class="flex-1">
                    <p class="font-semibold text-sm">{{ $report->deskripsi }}</p>
                    @php
                    $color = match(strtolower($report->status)) {
                    'pending' => 'text-orange-600',
                    'diproses' => 'text-blue-600',
                    'selesai' => 'text-green-600',
                    'dibatalkan' => 'text-red-600',
                    'ditolak' => 'text-red-600',
                    default => 'text-gray-500'
                    };
                    @endphp
                    <p class="text-xs {{ $color }} capitalize">
                        {{ $report->status }}
                    </p>
                </div>

                <span class="text-xs text-gray-400">
                    #LP{{ str_pad($report->id, 4, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <!-- TIMELINE -->
        <div class="px-4">

            @php
            $status = $report->status;
            @endphp

            <div class="space-y-6">

                <!-- STEP 1 -->
                <div class="flex gap-3">


                    <div>
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">

                                <!-- BULATAN -->
                                <div class="w-4 h-4 rounded-full 
        {{ in_array($status, ['dibatalkan', 'ditolak']) ? 'bg-red-500' : 'bg-blue-600' }}">
                                </div>

                                <!-- GARIS (hilang kalau dibatalkan) -->
                                @if($status != 'dibatalkan')
                                <div class="w-[2px] h-full bg-gray-300"></div>
                                @endif

                            </div>

                            <div>
                                <!-- JUDUL -->
                                <p class="font-semibold text-sm 
        {{ $status == 'dibatalkan' ? 'text-red-600' : '' }}">

                                    {{
    $status == 'dibatalkan'
    ? 'Laporan Dibatalkan'
    : ($status == 'ditolak'
        ? 'Laporan Ditolak'
        : 'Laporan Dibuat')
}}

                                </p>

                                <!-- WAKTU -->
                                <p class="text-xs text-gray-400">
                                    @if($status == 'dibatalkan')
                                    {{ $report->dibatalkan_at 
                ? \Carbon\Carbon::parse($report->dibatalkan_at)->format('d M Y, H:i') 
                : '-' }}
                                    @else
                                    {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y, H:i') }}
                                    @endif
                                </p>

                                <!-- DESKRIPSI -->
                                <p class="text-xs text-gray-400">
                                    {{
    $status == 'dibatalkan'
    ? 'Laporan telah dibatalkan oleh Anda.'
    : ($status == 'ditolak'
        ? 'Laporan telah ditolak oleh admin.'
        : 'Laporan Anda telah kami terima.')
}}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- STEP 2 -->
                @if(!in_array($status, ['dibatalkan', 'ditolak']))
                <div class="flex gap-3">
                    <div class="flex flex-col items-center">
                        <div class="w-4 h-4 rounded-full 
                        {{ in_array($status, ['diproses','selesai']) ? 'bg-blue-600' : 'bg-gray-300' }}">
                        </div>
                        <div class="w-[2px] h-full bg-gray-300"></div>
                    </div>

                    <div>
                        <p class="font-semibold text-sm">Diproses</p>
                        <p class="text-xs text-gray-400">
                            {{ $report->diproses_at 
                            ? \Carbon\Carbon::parse($report->diproses_at)->format('d M Y, H:i') 
                            : '-' }}
                        </p>
                        <p class="text-xs text-gray-400">
                            Sedang ditangani oleh petugas.
                        </p>
                    </div>
                </div>
                @endif

                <!-- STEP 3 -->
                @if($status != 'dibatalkan')
                <div class="flex gap-3">
                    <div class="flex flex-col items-center">
                        <div class="w-4 h-4 rounded-full 
                        {{ $status == 'selesai' ? 'bg-blue-600' : 'bg-gray-300' }}">
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-sm">Selesai</p>
                        <p class="text-xs text-gray-400">
                            {{ $report->selesai_at 
                            ? \Carbon\Carbon::parse($report->selesai_at)->format('d M Y, H:i') 
                            : '-' }}
                        </p>
                        <p class="text-xs text-gray-400">
                            Menunggu konfirmasi penyelesaian.
                        </p>
                    </div>
                </div>
                @endif

            </div>

        </div>

    </div>

</body>

</html>