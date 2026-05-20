<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100 relative overflow-hidden
    md:max-w-7xl md:mx-auto md:px-6">

        <!-- 🔷 HEADER -->
        <div class="bg-blue-600 text-white p-4 flex items-center gap-3 rounded-b-2xl">
            <a href="{{ route('dashboard') }}">←</a>
            <h1 class=" font-semibold">Buat Laporan Baru</h1>
        </div>
        @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded-lg">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4">
            @csrf

            <!-- 📸 FOTO -->
            <div>
                <label class="text-sm font-semibold">Foto Masalah *</label>

                <div class="border-2 border-dashed rounded-xl p-6 text-center bg-gray-50 mt-2">
                    <input type="file" name="foto" id="fotoInput" class="hidden">

                    <label for="fotoInput" class="cursor-pointer text-gray-400">
                        Klik untuk upload foto <br> atau ambil gambar
                    </label>
                    <div id="previewContainer" class="flex gap-2 mt-3 flex-wrap"></div>
                </div>
            </div>

            <!-- 📂 KATEGORI -->
            <div>
                <label class="text-sm font-semibold">Kategori *</label>

                <div class="relative mt-1">
                    <button type="button" onclick="toggleDropdown()"
                        class="w-full border p-2 rounded-lg text-left bg-white">
                        <span id="selectedKategori">Pilih Kategori</span>
                    </button>

                    <div id="dropdownKategori" class="hidden absolute w-full bg-white border rounded-lg mt-1 shadow z-10">
                        <div onclick="selectKategori('Listrik')" class="p-2 hover:bg-blue-100 cursor-pointer">Listrik</div>
                        <div onclick="selectKategori('Air / Sanitasi')" class="p-2 hover:bg-blue-100 cursor-pointer">Air / Sanitasi</div>
                        <div onclick="selectKategori('Fasilitas')" class="p-2 hover:bg-blue-100 cursor-pointer">Fasilitas</div>
                        <div onclick="selectKategori('Bangunan')" class="p-2 hover:bg-blue-100 cursor-pointer">Bangunan</div>
                        <div onclick="selectKategori('Kebersihan')" class="p-2 hover:bg-blue-100 cursor-pointer">Kebersihan</div>
                        <div onclick="selectKategori('Lainnya')" class="p-2 hover:bg-blue-100 cursor-pointer">Lainnya</div>
                    </div>

                    <input type="hidden" name="kategori" id="inputKategori">
                </div>
            </div>

            <!-- 📍 LOKASI -->
            <div>
                <label class="text-sm font-semibold">Lokasi</label>
                <input type="text" name="lokasi" required
                    class="w-full border p-2 rounded-lg mt-1"
                    placeholder="Contoh: Gedung A">
            </div>

            <!-- 📝 DESKRIPSI -->
            <div>
                <label class="text-sm font-semibold">Deskripsi *</label>

                <textarea name="deskripsi" rows="4"
                    placeholder="Jelaskan masalah yang terjadi..."
                    class="w-full border p-2 rounded-lg mt-1"></textarea>
            </div>

            <!-- 🚀 BUTTON -->
            <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold">
                Kirim Laporan
            </button>

        </form>

    </div>
    <script>
        function toggleDropdown() {
            document.getElementById('dropdownKategori').classList.toggle('hidden');
        }

        function selectKategori(value) {
            document.getElementById('selectedKategori').innerText = value;
            document.getElementById('inputKategori').value = value;
            document.getElementById('dropdownKategori').classList.add('hidden');
        }
    </script>
    <script>
        document.getElementById('fotoInput').addEventListener('change', function(event) {
            let preview = document.getElementById('previewContainer');
            preview.innerHTML = '';

            let files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-20 h-20 object-cover rounded-lg";
                    preview.appendChild(img);
                }

                reader.readAsDataURL(files[i]);
            }
        });
    </script>



</body>

</html>