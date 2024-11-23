<x-public.layout>
    <div class="container mx-auto p-6">
        {{-- Header dan Pencarian --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">Daftar Buku</h2>

            {{-- Form Pencarian dan Filter Kategori --}}
            <form action="" method="GET" class="w-full sm:w-2/3 mt-4 sm:mt-0 flex space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari buku..."
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                {{-- Dropdown Filter Kategori --}}
                <select name="category"
                    class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ request('category') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">Cari</button>
            </form>
        </div>

        {{-- Tampilkan Buku --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($books->isEmpty())
                <div class="text-center text-gray-600">Tidak ada buku yang ditemukan</div>
            @endif
            @foreach ($books as $book)
                <div
                    class="bg-white border rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                        class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-sm">{{ $book->author }}</p>
                        <p class="text-gray-500 text-xs mt-1">{{ $book->publisher }}</p>

                        {{-- Kategori Buku --}}
                        <div class="mt-2 flex flex-wrap">
                            @foreach ($book->categories as $category)
                                <span
                                    class="inline-block bg-blue-100 text-blue-500 text-xs py-1 px-2 rounded-full mr-1 mb-1">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Pinjam Buku --}}
                        @if (Auth::check())
                            <!-- Jika pengguna sudah login, tampilkan tombol pinjam -->
                            <a href=""
                                class="mt-3 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Pinjam</a>
                        @else
                            <!-- Jika pengguna belum login, arahkan ke halaman login -->
                            <a href="{{ route('login') }}"
                                class="mt-3 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Login
                                untuk Pinjam</a>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            <div class="">
                {{ $books->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-public.layout>
