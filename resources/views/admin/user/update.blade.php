<x-admin.layout>

    <div class="mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Ubah Pengguna</h2>
            {{-- back button --}}
            <a href="{{ route('user.index') }}"
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
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT') {{-- Menambahkan method PUT untuk update --}}

            {{-- name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            {{-- email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti password</small>
            </div>

            {{-- Phone --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="number" name="phone" id="phone"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('phone', $user->phone) }}" required>
            </div>

            {{-- role --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
                </select>
            </div>

            {{-- image --}}
            <div>
                <label for="user_image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="user_image" id="user_image"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @if ($user->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $user->user_image) }}" alt="Current Image"
                            class="h-20 w-20 object-cover rounded-full">
                    </div>
                @endif
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti foto</small>
            </div>

            {{-- submit --}}
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </form>
    </div>

</x-admin.layout>
