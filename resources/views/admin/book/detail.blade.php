<x-admin.layout>
    <div class="mx-auto max-w-4xl p-6 ">
        <div class="flex justify-between items-center mb-6">
            {{-- Page title --}}
            <h2 class="text-2xl font-semibold text-gray-800">Detail Buku</h2>
            {{-- Back button --}}
            <a href="{{ route('book.index') }}"
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

        {{-- Detail Book Card --}}
        <div class="">
            {{-- Book Cover and Info --}}
            <div class="flex flex-col md:flex-row items-start md:items-center">
                {{-- Book Cover --}}
                <div class="w-full md:w-1/3">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                            class="w-full h-auto object-cover rounded-lg">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                            <span class="text-gray-500">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>

                {{-- Book Info --}}
                <div class="w-full md:w-2/3 mt-6 md:mt-0 md:ml-8 space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-gray-600"><span class="font-medium">Penulis:</span> {{ $book->author }}</p>
                    <p class="text-gray-600"><span class="font-medium">Penerbit:</span> {{ $book->publisher }}</p>
                    <p class="text-gray-600"><span class="font-medium">Tahun Terbit:</span> {{ $book->year }}</p>
                    <p class="text-gray-600"><span class="font-medium">ISBN:</span> {{ $book->isbn }}</p>
                    <p class="text-gray-600">
                        <span class="font-medium">Kategori:</span>
                        @foreach ($book->categories as $category)
                            <span class="text-blue-500">{{ $category->name }}</span>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </p>
                </div>
            </div>

            {{-- Book Description --}}
            <div class="mt-8">
                <h4 class="text-lg font-semibold text-gray-700">Deskripsi</h4>
                <p class="mt-2 text-gray-600">{{ $book->description ?? 'Deskripsi tidak tersedia.' }}</p>
            </div>
        </div>
    </div>
</x-admin.layout>
