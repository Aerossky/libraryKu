<x-admin.layout>

    <div class=" mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Tambah Kategori Baru</h2>
            {{-- back button --}}
            <a href="{{ route('category.index') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
        </div>

        {{-- Alert --}}
        @if ($errors->any())
            <div class="">
                <ul>
                    @foreach ($errors->all() as $error)
                        <x-ui.alert type="error" :message="$error" />
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- form --}}
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
            </div>

            {{-- submit --}}
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>

        </form>
    </div>

</x-admin.layout>
