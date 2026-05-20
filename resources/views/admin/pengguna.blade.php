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
                Daftar Pengguna
            </h1>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left p-4">
                            Nama
                        </th>

                        <th class="text-left p-4">
                            Email
                        </th>

                        <th class="text-left p-4">
                            Bergabung
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="p-4 font-semibold">
                            {{ $user->name }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="p-4 text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3" class="p-6 text-center text-gray-400">
                            Belum ada pengguna
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>