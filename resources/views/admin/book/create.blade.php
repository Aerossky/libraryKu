<x-admin.layout>
    <div class=" mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Tambah Buku Baru</h2>
            {{-- back button --}}
            <a href="{{ route('book.index') }}"
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
        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('title') }}" required>
            </div>

            {{-- Author --}}
            <div class="mt-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" name="author" id="author"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('author') }}" required>
            </div>

            {{-- Publisher --}}
            <div class="mt-4">
                <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
                <input type="text" name="publisher" id="publisher"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('publisher') }}" required>
            </div>

            {{-- Published Date --}}
            <div class="mt-4">
                <label for="published_date" class="block text-sm font-medium text-gray-700">Published Date</label>
                <input type="date" name="published_date" id="published_date"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('published_date') }}" required>
            </div>

            {{-- ISBN --}}
            <div class="mt-4">
                <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                <input type="number" name="isbn" id="isbn"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('isbn') }}" required>
            </div>

            {{-- Language --}}
            <div class="mt-4">
                <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                <input type="text" name="language" id="language"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('language') }}">
            </div>

            {{-- Description --}}
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description') }}</textarea>
            </div>

            {{-- Categories --}}
            <div class="mt-4">
                <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                <select id="categories"
                    class="js-example-basic-multiple w-full mt-1 block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    name="categories[]" multiple="multiple">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (in_array($category->id, old('categories', []))) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Kategori dapat di pilih lebih dari satu.</p>
            </div>


            {{-- Cover Image --}}
            <div class="mt-4">
                <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
            </div>

            {{-- Submit Button --}}
            <div class="mt-6">
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>


    </div>

</x-admin.layout>
