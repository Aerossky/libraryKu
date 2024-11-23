<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="flex flex-col min-h-screen bg-background font-poppins overflow-x-hidden">

    {{-- Navbar --}}
    <x-admin.navbar name="joko" email="joko@gmail.com"
        image="https://cdn-icons-png.flaticon.com/512/149/149071.png" />
    {{-- Aside --}}
    <x-admin.aside />

    <!-- Main Content -->
    <main class="p-4
        sm:ml-64">
        {{-- Content --}}
        <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
            {{ $slot }}
        </div>
    </main>


</body>

</html>
