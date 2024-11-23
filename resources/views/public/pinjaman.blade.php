<x-public.layout>
    <div class="container mx-auto p-6">
        {{-- Header dan Pencarian --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">Daftar Pinjaman Buku</h2>
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
                            {{-- Menampilkan status pinjaman berdasarkan status buku --}}
                            <div class="mt-3 text-sm">
                                @switch($book->status)
                                    @case('pending')
                                        <span class="text-gray-500">Status: Menunggu persetujuan</span>
                                    @break

                                    @case('approved')
                                        <span class="text-green-500">Status: Disetujui</span>
                                    @break

                                    @case('rejected')
                                        <span class="text-red-500">Status: Ditolak</span>
                                        <div class="mt-3 text-gray-500">Login untuk meminjam buku</div>
                                    @break

                                    @default
                                        <span class="text-gray-500">Status tidak diketahui</span>
                                @endswitch
                            </div>
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
