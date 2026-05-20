<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100" x-data="{ sidebar:false }">

    <div class="w-full min-h-screen bg-gray-100 relative overflow-hidden
            md:max-w-7xl md:mx-auto md:px-6">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-500 px-5 pt-12 pb-6 rounded-b-[30px] text-white relative">

            <!-- HEADER -->
            <div class="flex items-center gap-4">

                <button @click="sidebar = !sidebar"
                    class="text-3xl text-white transition duration-300 hover:scale-110">
                    ☰
                </button>

                <h1 class="text-2xl font-bold">
                    Dashboard
                </h1>

            </div>

            <!-- OVERLAY -->
            <div x-show="sidebar"
                x-transition.opacity
                class="fixed inset-0 bg-black/40 z-40"
                @click="sidebar = false">
            </div>

            <!-- SIDEBAR -->
            <div x-show="sidebar"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed top-0 left-0 w-72 h-full bg-white z-50 shadow-2xl rounded-r-3xl overflow-hidden">

                <!-- TOP -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-500 p-6 text-white">

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                            🛡️
                        </div>

                        <div>

                            <h1 class="text-3xl font-extrabold">
                                LAPORKU
                            </h1>

                            <p class="text-sm text-blue-100">
                                Admin Dashboard
                            </p>

                        </div>

                    </div>

                </div>

                <!-- MENU -->
                <div class="p-5 space-y-3">

                    <a href="/admin"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-blue-50 text-blue-600 font-semibold hover:bg-blue-100 transition">

                        📊 Dashboard

                    </a>

                    <a href="/admin/laporan"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-700 hover:bg-gray-100 transition">

                        📄 Laporan

                    </a>

                    <a href="/admin/pengguna"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-700 hover:bg-gray-100 transition">

                        👤 Pengguna

                    </a>

                </div>

                <!-- LOGOUT -->
                <div class="absolute bottom-6 left-5 right-5">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            class="w-full py-3 rounded-2xl border border-red-200 text-red-500 font-semibold hover:bg-red-50 transition">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">

                <div class="bg-white shadow-lg rounded-2xl p-4 text-black">
                    <p class="text-sm">Total</p>
                    <h2 class="text-2xl font-bold">
                        {{ $total }}
                    </h2>
                </div>

                <div class="bg-white shadow-lg rounded-2xl p-4 text-black">
                    <p class="text-sm">Pending</p>
                    <h2 class="text-2xl font-bold text-yellow-300">
                        {{ $pending }}
                    </h2>
                </div>

                <div class="bg-white shadow-lg rounded-2xl p-4 text-black">
                    <p class="text-sm">Diproses</p>
                    <h2 class="text-2xl font-bold text-blue-200">
                        {{ $diproses }}
                    </h2>
                </div>

                <div class="bg-white shadow-lg rounded-2xl p-4 text-black">
                    <p class="text-sm">Selesai</p>
                    <h2 class="text-2xl font-bold text-green-300">
                        {{ $selesai }}
                    </h2>
                </div>

            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-4 mx-4">

            <!-- RATA RATA RATING -->
            <div class="bg-white rounded-2xl p-4 shadow">
                <p class="text-gray-500 text-sm">
                    Rata-rata Rating
                </p>

                <h2 class="text-2xl font-bold text-yellow-500">
                    ⭐ {{ number_format($avgRating, 1) }}
                </h2>
            </div>

            <!-- DITOLAK -->
            <div class="bg-white rounded-2xl p-4 shadow">
                <p class="text-gray-500 text-sm">
                    Ditolak
                </p>

                <h2 class="text-2xl font-bold text-red-500">
                    {{ $ditolak }}
                </h2>
            </div>

            <!-- PERFORMA -->
            <div class="bg-white rounded-2xl p-4 shadow">
                <p class="text-gray-500 text-sm">
                    Rata-rata Performa
                </p>

                <h2 class="text-2xl font-bold text-green-500">
                    {{ $performance }}%
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Berdasarkan laporan selesai
                </p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6 mx-4">

            <!-- TABEL -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-4 overflow-x-auto">

                <h2 class="font-bold text-lg mb-4">
                    Laporan Terbaru
                </h2>

                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-gray-500 border-b">
                            <th class="text-left pb-3">Pelapor</th>
                            <th class="text-left pb-3">Laporan</th>
                            <th class="text-left pb-3">Status</th>
                            <th class="text-left pb-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($reports as $item)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="py-3">
                                {{ $item->user->name ?? 'User' }}
                            </td>

                            <td class="py-3">
                                {{ Str::limit($item->deskripsi, 25) }}
                            </td>

                            <td class="py-3">

                                <span class="text-xs px-3 py-1 rounded-full font-semibold

                        @if($item->status == 'pending')
                            bg-orange-100 text-orange-600

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

                            <td class="py-3">

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

            <!-- KANAN -->
            <div class="space-y-4">

                <!-- Grafik -->
                <div class="bg-white rounded-2xl shadow-sm p-4">

                    <h2 class="font-bold text-lg mb-4">
                        Grafik Laporan
                    </h2>

                    <div class="w-[250px] h-[250px] mx-auto">
                        <canvas id="laporanChart"></canvas>
                    </div>

                </div>

            </div>

        </div>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('laporanChart');

        new Chart(ctx, {
            type: 'doughnut',

            data: {
                labels: ['Pending', 'Diproses', 'Selesai', 'Ditolak'],

                datasets: [{
                    data: [
                        @json($pending),
                        @json($diproses),
                        @json($selesai),
                        @json($ditolak)
                    ],

                    backgroundColor: [
                        '#facc15',
                        '#3b82f6',
                        '#22c55e',
                        '#ef4444'
                    ],

                    borderWidth: 0
                }]
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {

            sidebar.classList.remove('left-[-280px]');
            sidebar.classList.add('left-0');

            overlay.classList.remove('hidden');

        });

        overlay.addEventListener('click', () => {

            sidebar.classList.remove('left-0');
            sidebar.classList.add('left-[-280px]');

            overlay.classList.add('hidden');

        });
    </script>

</body>

</html>