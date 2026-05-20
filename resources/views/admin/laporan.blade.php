<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="min-h-screen p-6">

        <!-- HEADER -->
        <div class="flex items-center gap-4 mb-6">

            <a href="/admin"
                class="text-2xl">
                ←
            </a>

            <h1 class="text-3xl font-bold text-gray-800">
                Semua Laporan
            </h1>

        </div>

        <!-- SEARCH -->
        <div class="mb-5">

            <input type="text"
                placeholder="Cari laporan..."
                class="w-full bg-white rounded-2xl px-5 py-4 shadow-sm outline-none">

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left p-4">
                            Pelapor
                        </th>

                        <th class="text-left p-4">
                            Kategori
                        </th>

                        <th class="text-left p-4">
                            Lokasi
                        </th>

                        <th class="text-left p-4">
                            Status
                        </th>

                        <th class="text-left p-4">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($reports as $item)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="p-4">
                            {{ $item->user->name ?? '-' }}
                        </td>

                        <td class="p-4">
                            {{ $item->kategori }}
                        </td>

                        <td class="p-4">
                            {{ $item->lokasi }}
                        </td>

                        <td class="p-4">

                            <span class="
                            px-3 py-1 rounded-full text-xs font-semibold

                            @if($item->status == 'pending')
                                bg-yellow-100 text-yellow-600

                            @elseif($item->status == 'diproses')
                                bg-blue-100 text-blue-600

                            @elseif($item->status == 'selesai')
                                bg-green-100 text-green-600

                            @elseif($item->status == 'ditolak')
                                bg-red-100 text-red-600
                            @endif
                        ">

                                {{ ucfirst($item->status) }}

                            </span>

                        </td>

                        <td class="p-4">

                            <a href="{{ url('/admin/laporan/'.$item->id) }}"
                                class="text-blue-600 font-semibold">
                                Lihat
                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>