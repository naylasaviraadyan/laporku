<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100">

        <div class="max-w-5xl mx-auto px-4 md:px-8">

            <!-- HEADER -->
            <div class="bg-blue-600 text-white p-4 flex items-center gap-3">
                <a href="{{ route('profil') }}">←</a>
                <h1 class="font-semibold text-lg">Tentang Aplikasi</h1>
            </div>

            <!-- CONTENT -->
            <div class="flex-1 p-4 space-y-4">

                <!-- CARD UTAMA -->
                <div class="bg-white rounded-2xl shadow p-6 text-center">

                    <div class="text-5xl mb-3">📢</div>

                    <h2 class="text-xl font-bold text-blue-600">LAPORKU</h2>

                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Aplikasi pengaduan sarana dan prasarana yang membantu
                        pengguna melaporkan kerusakan dengan cepat, mudah,
                        dan transparan.
                    </p>

                </div>

                <!-- FITUR -->
                <div class="bg-white rounded-xl shadow p-4 space-y-3 text-sm">

                    <div class="flex items-center gap-2">
                        <span>✔️</span>
                        <p>Lapor kerusakan fasilitas</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span>✔️</span>
                        <p>Upload foto bukti</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span>✔️</span>
                        <p>Pantau status laporan</p>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="text-center text-xs text-gray-400 mt-5">
                    © 2026 LAPORKU
                </div>

            </div>

        </div>
    </div>

</body>

</html>