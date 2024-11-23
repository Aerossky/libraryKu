<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Default Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="flex flex-col min-h-screen bg-background font-poppins overflow-x-hidden">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex flex-col items-center justify-center mb-2">
                <img src="{{ asset('assets/images/logo/type_logo.png') }}" alt="Logo"
                    class="w-1/3 sm:w-1/4 md:w-2/6 lg:w-3/6 xl:w-4/6 mb-4">
            </div>

            <p class="text-sm text-gray-600 mb-4 text-center">Halaman ini hanya untuk login admin. Jika Anda bukan
                admin,
                harap hubungi administrator sistem.</p>

            {{-- Error message --}}
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

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Email Anda" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Kata sandi Anda">
                </div>
                <button type="submit"
                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 me-2 mb-2 focus:outline-none transition-all duration-300 ease-in-out">
                    Masuk
                </button>

            </form>
        </div>
    </div>

</body>

</html>
