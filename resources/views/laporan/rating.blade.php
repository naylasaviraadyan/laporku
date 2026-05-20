<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto min-h-screen">

        <!-- HEADER -->
        <div class="bg-blue-600 text-white p-4 flex items-center gap-3">
            <a href="{{ route('laporan.show', $report->id) }}">←</a>
            <h1 class="font-semibold text-lg">Beri Penilaian</h1>
        </div>

        <div class="p-4 space-y-4">

            <!-- CARD LAPORAN -->
            <div class="bg-white p-3 rounded-xl shadow flex items-center gap-3">
                <img src="{{ asset('storage/'.$report->foto) }}"
                    class="w-14 h-14 rounded-lg object-cover">

                <div class="flex-1">
                    <p class="font-semibold text-sm">{{ $report->deskripsi }}</p>
                    <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">
                        Selesai
                    </span>
                </div>

                <span class="text-xs text-gray-400">
                    #LP{{ str_pad($report->id, 4, '0', STR_PAD_LEFT) }}
                </span>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('laporan.rating.store', $report->id) }}">
                @csrf

                <!-- PERTANYAAN -->
                <p class="text-sm font-medium text-gray-700">
                    Seberapa puas Anda dengan penanganan laporan ini?
                </p>

                <!-- ⭐ STAR RATING -->
                <div class="flex gap-2 text-4xl mt-3">
                    @for($i=1; $i<=5; $i++)
                        <span class="star cursor-pointer text-gray-300 transition-all duration-200 hover:scale-110">
                        ★
                        </span>
                        @endfor
                </div>

                <!-- TEXT HASIL -->
                <p id="ratingText" class="text-sm text-gray-500 mt-2">
                    Belum dipilih
                </p>

                <!-- INPUT HIDDEN -->
                <input type="hidden" name="rating" id="ratingInput">

                <!-- KOMENTAR -->
                <div class="mt-4">
                    <label class="text-sm font-medium text-gray-700">
                        Komentar (opsional)
                    </label>

                    <textarea name="ulasan"
                        class="w-full border rounded-xl p-3 mt-2 text-sm"
                        placeholder="Sampaikan komentar Anda..."></textarea>
                </div>

                <!-- BUTTON -->
                <button class="w-full bg-blue-600 text-white py-3 rounded-xl mt-5 font-semibold">
                    Kirim Penilaian
                </button>

            </form>

        </div>

    </div>

    <!-- ⭐ SCRIPT BINTANG -->
    <script>
        const stars = document.querySelectorAll('.star');
        const input = document.getElementById('ratingInput');
        const text = document.getElementById('ratingText');

        const labels = ["Buruk", "Kurang", "Cukup", "Baik", "Sangat Baik"];

        stars.forEach((star, index) => {

            // hover effect
            star.addEventListener('mouseover', () => {
                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-300', i <= index);
                });
            });

            // balik ke kondisi klik
            star.addEventListener('mouseout', () => {
                let value = input.value || 0;

                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-400', i < value);
                    s.classList.toggle('text-gray-300', i >= value);
                });
            });

            // klik
            star.addEventListener('click', () => {
                let value = index + 1;
                input.value = value;

                stars.forEach((s, i) => {
                    if (i < value) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });

                // animasi klik kecil
                star.classList.add('scale-125');
                setTimeout(() => {
                    star.classList.remove('scale-125');
                }, 150);

                text.innerText = labels[value - 1] + " (" + value + "/5)";
            });

        });
    </script>

</body>

</html>