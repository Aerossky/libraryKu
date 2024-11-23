<x-admin.layout>
    <div class="mx-auto max-w-4xl p-6 ">
        {{-- Page Header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Buku dalam Kategori: {{ $category->name }}</h2>
            <a href="{{ route('category.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                Kembali
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <x-ui.alert type="success" :message="session('success')" />
        @elseif (session('error'))
            <x-ui.alert type="error" :message="session('error')" />
        @endif

        {{-- Buku dalam Kategori --}}
        @if ($books->isEmpty())
            <p class="text-gray-500">Tidak ada buku dalam kategori ini.</p>
        @else
            <table class="w-full border rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-4 text-left text-gray-600">#</th>
                        <th class="py-3 px-4 text-left text-gray-600">Judul Buku</th>
                        <th class="py-3 px-4 text-left text-gray-600">Penulis</th>
                        <th class="py-3 px-4 text-left text-gray-600">Penerbit</th>
                        <th class="py-3 px-4 text-left text-gray-600">ISBN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="border-b hover:bg-gray-50 transition duration-200">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $book->title }}</td>
                            <td class="py-3 px-4">{{ $book->author }}</td>
                            <td class="py-3 px-4">{{ $book->publisher }}</td>
                            <td class="py-3 px-4">{{ $book->isbn }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin.layout>
