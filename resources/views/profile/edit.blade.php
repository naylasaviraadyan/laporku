<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="w-full min-h-screen bg-gray-100">

        <!-- HEADER -->
        <div class="bg-blue-600 text-white p-4 flex items-center gap-3">
            <a href="{{ route('profil') }}">←</a>
            <h1 class="font-semibold text-lg">Edit Profil</h1>
        </div>

        <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" class="p-4 space-y-5">
            @csrf

            <!-- FOTO PROFIL -->
            <div class="bg-white p-4 rounded-xl shadow text-center">

                <label class="text-sm text-gray-500">Foto Profil</label>

                <div class="mt-3">
                    <img id="preview"
                        src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                        class="w-20 h-20 rounded-full mx-auto object-cover">
                </div>

                <input type="file" name="foto" id="fotoInput" class="hidden">

                <button type="button" onclick="document.getElementById('fotoInput').click()"
                    class="mt-3 text-blue-600 text-sm">
                    Ganti Foto
                </button>
            </div>
            <!-- NAMA -->
            <div class="bg-white p-4 rounded-xl shadow space-y-2">
                <label class="text-sm text-gray-500">Nama</label>
                <input type="text" name="name"
                    value="{{ Auth::user()->name }}"
                    class="w-full border p-2 rounded-lg">
            </div>

            <!-- PASSWORD -->
            <div class="bg-white p-4 rounded-xl shadow space-y-3">

                <div>
                    <label class="text-sm text-gray-500">Password Lama</label>

                    <input type="password" name="current_password"
                        class="w-full p-2 rounded-lg mt-1 border
    @error('current_password') border-red-500 bg-red-50 shake @enderror">

                    @error('current_password')
                    <p class="text-red-600 text-sm mt-1 font-medium">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm text-gray-500">Password Baru</label>
                    <input type="password" name="new_password"
                        class="w-full border p-2 rounded-lg mt-1">
                </div>

            </div>

            <!-- BUTTON -->
            <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold shadow">
                Simpan Perubahan
            </button>

        </form>

    </div>

    <script>
        document.getElementById('fotoInput').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

</body>

</html>