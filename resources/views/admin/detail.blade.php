<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body></body>

<div class="min-h-screen bg-gray-100 pb-24">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-500
        px-6 pt-14 pb-8 rounded-b-[35px] text-white">

        <div class="flex items-center justify-between">

            <a href="/admin"
                class="text-2xl">
                ←
            </a>

            <h1 class="text-2xl font-bold">
                Detail Laporan
            </h1>

            <div></div>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="px-5 -mt-6">

        <div class="bg-white rounded-3xl shadow-sm p-5">

            {{-- FOTO --}}
            @if($report->foto)
            <img src="{{ asset('storage/' . $report->foto) }}"
                class="w-full h-56 object-cover rounded-2xl">
            @endif

            {{-- JUDUL --}}
            <h2 class="text-2xl font-bold text-gray-800 mt-5">
                {{ $report->kategori }}
            </h2>

            {{-- STATUS --}}
            <div class="mt-3">

                <span class="
                    px-4 py-2 rounded-full text-sm font-semibold

                    @if($report->status == 'pending')
                        bg-yellow-100 text-yellow-600
                    @elseif($report->status == 'diproses')
                        bg-blue-100 text-blue-600
                    @elseif($report->status == 'selesai')
                        bg-green-100 text-green-600
                    @elseif($report->status == 'ditolak')
                        bg-red-100 text-red-600
                    @endif
                ">
                    {{ ucfirst($report->status) }}
                </span>

            </div>

            {{-- INFO --}}
            <div class="mt-6 space-y-4">

                <div>
                    <p class="text-sm text-gray-400">
                        Pelapor
                    </p>

                    <p class="font-semibold text-gray-700">
                        {{ $report->user->name }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">
                        Kategori
                    </p>

                    <p class="font-semibold text-gray-700">
                        {{ $report->kategori }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">
                        Lokasi
                    </p>

                    <p class="font-semibold text-gray-700">
                        {{ $report->lokasi }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">
                        Tanggal
                    </p>

                    <p class="font-semibold text-gray-700">
                        {{ $report->created_at->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">
                        Deskripsi
                    </p>

                    <p class="text-gray-700 leading-relaxed">
                        {{ $report->deskripsi }}
                    </p>
                </div>

            </div>

        </div>



        {{-- UPDATE STATUS --}}
        <div class="mt-5 bg-white rounded-3xl shadow-sm p-5">

            <h3 class="font-bold text-lg mb-4">
                Update Status
            </h3>

            {{-- PENDING --}}
            @if($report->status == 'pending')

            <div class="grid grid-cols-2 gap-3">

                {{-- PROSES --}}
                <form action="/laporan/{{ $report->id }}/update/diproses"
                    method="POST">
                    @csrf

                    <button
                        class="w-full bg-blue-500 text-white py-3 rounded-2xl font-semibold">

                        Proses Laporan

                    </button>

                </form>

                {{-- TOLAK --}}
                <form action="/laporan/{{ $report->id }}/update/ditolak"
                    method="POST">
                    @csrf

                    <button
                        class="w-full bg-red-500 text-white py-3 rounded-2xl font-semibold">

                        Tolak

                    </button>

                </form>

            </div>

            @endif


            {{-- DIPROSES --}}
            @if($report->status == 'diproses')

            <form action="/laporan/{{ $report->id }}/update/selesai"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4">

                @csrf

                {{-- FOTO BUKTI --}}
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Upload Bukti Pengerjaan
                    </label>

                    <input type="file"
                        name="foto_bukti"
                        class="w-full mt-2 border rounded-2xl px-4 py-3">

                </div>

                {{-- CATATAN --}}
                <div>

                    <label class="text-sm font-semibold text-gray-700">
                        Catatan Admin
                    </label>

                    <textarea
                        name="catatan_admin"
                        rows="4"
                        class="w-full mt-2 border rounded-2xl px-4 py-3"
                        placeholder="Masukkan catatan..."></textarea>

                </div>

                <div class="grid grid-cols-2 gap-3">

                    {{-- SELESAI --}}
                    <button
                        class="bg-green-500 text-white py-3 rounded-2xl font-semibold">

                        Tandai Selesai

                    </button>

            </form>

            {{-- TOLAK --}}
            <form action="/laporan/{{ $report->id }}/update/ditolak"
                method="POST">

                @csrf

                <button
                    class="w-full bg-red-500 text-white py-3 rounded-2xl font-semibold">

                    Tolak

                </button>

            </form>

        </div>

        @endif

        {{-- RATING USER --}}
        @if($report->rating)

        <div class="mt-5 bg-white rounded-3xl shadow-sm p-5">

            <h3 class="font-bold text-lg mb-4">
                Penilaian User
            </h3>

            <div class="flex items-center gap-2 mb-3">

                <span class="text-yellow-500 text-2xl">
                    ⭐
                </span>

                <span class="text-2xl font-bold">
                    {{ $report->rating }}/5
                </span>

            </div>

            @if($report->ulasan)

            <div class="bg-gray-100 rounded-2xl p-4 text-gray-700">

                "{{ $report->ulasan }}"

            </div>

            @endif

        </div>

        @endif
        {{-- SELESAI --}}
        @if($report->status == 'selesai')

        <div class="bg-green-50 border border-green-200
    rounded-2xl p-4 text-green-700 font-semibold">

            ✅ Laporan telah selesai ditangani

        </div>

        @endif


        {{-- DITOLAK --}}
        @if($report->status == 'ditolak')

        <div class="bg-red-50 border border-red-200
    rounded-2xl p-4 text-red-700 font-semibold">

            ❌ Laporan telah ditolak admin

        </div>

        @endif

    </div>

</div>

</div>
</body>

</html>