<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LAPORKU</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white w-80 rounded-3xl shadow-xl p-6 relative">

        <!-- 🔙 Back -->
        <a href="/" class="absolute left-4 top-4 text-gray-400 hover:text-blue-600 text-lg">
            ←
        </a>

        <!-- Icon -->
        <div class="bg-blue-600 w-14 h-14 mx-auto rounded-2xl flex items-center justify-center">
            <span class="text-white text-xl font-bold">!</span>
        </div>

        <!-- Title -->
        <h2 class="text-xl font-bold text-center text-blue-600 mt-3">Daftar</h2>
        <p class="text-sm text-center text-gray-500">Buat akun baru</p>
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded text-sm mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="mt-5 space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-400">

            <input type="email" name="email" placeholder="Email"
                class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-400">

            <input type="password" name="password" placeholder="Password"
                class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-400">

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-400">

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-full font-semibold">
                Daftar
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold">Login</a>
        </p>

    </div>

</body>

</html>