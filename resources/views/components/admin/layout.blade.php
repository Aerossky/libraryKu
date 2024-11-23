<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin LibraryKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Select 2 --}}
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Inisialisasi Select2 -->
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 dengan gaya yang sesuai
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih kategori", // Placeholder text
                allowClear: true, // Tombol untuk menghapus pilihan
                width: '100%', // Menjaga lebar elemen sesuai dengan kelas Tailwind `w-full`
            });

            // Re-select the old values after form validation failure
            var oldCategories = {{ json_encode(old('categories', [])) }};
            if (oldCategories.length > 0) {
                $('.js-example-basic-multiple').val(oldCategories).trigger('change');
            }
        });
    </script>
</body>

</html>
