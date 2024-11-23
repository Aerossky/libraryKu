<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Register' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen bg-background font-poppins overflow-x-hidden">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex flex-col items-center justify-center mb-4">
                <img src="{{ asset('assets/images/logo/type_logo.png') }}" alt="Logo"
                    class="w-1/3 sm:w-1/4 md:w-2/6 lg:w-3/6 xl:w-4/6 mb-4">
            </div>

            <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Buat Akun</h2>
            <p class="text-sm text-gray-600 mb-4 text-center">Lengkapi formulir berikut untuk mendaftar.</p>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="POST" class="space-y-6">
                @csrf
                @method('POST')

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Nama pengguna Anda" value="{{ old('username') }}">
                </div>

                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                    <input type="text" id="first_name" name="first_name" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Nama depan Anda" value="{{ old('first_name') }}">
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                    <input type="text" id="last_name" name="last_name" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Nama belakang Anda" value="{{ old('last_name') }}">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Email Anda" value="{{ old('email') }}">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Kata sandi Anda">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 focus:outline-none transition-all duration-300 ease-in-out">
                    Daftar
                </button>

            </form>
        </div>
    </div>
</body>

</html>
