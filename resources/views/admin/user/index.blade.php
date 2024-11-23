<x-admin.layout>

    {{-- Title --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Pengguna</h1>
        <a href="" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Tambah Pengguna
        </a>
    </div>

    {{-- Search Form --}}
    <div class="w-full flex justify-center">
        <form method="GET" action="" class="mb-4">
            <div class="flex">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                    class="form-input w-full px-4 py-2 border rounded-l-md max-w-md "
                    placeholder="Search by name, email, or agent code">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center">
        <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">No</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">

            @if ($users->isEmpty())
                <tr>
                    <td class="whitespace
                        -nowrap px-4 py-2 font-medium text-gray-900"
                        colspan="5">Tidak Ada Data</td>
                </tr>
            @endif
            @foreach ($users as $data)
                <tr>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $loop->iteration }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->name }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->email }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->phone }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->role }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}"
                            class="w-12 h-12 rounded-full">
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 flex space-x-2 justify-center items-center">
                        <!-- Button View -->
                        <a href="#"
                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                            View
                        </a>

                        <!-- Button Edit -->
                        <a href="#"
                            class="inline-block rounded bg-yellow-500 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-600">
                            Ubah
                        </a>

                        <!-- Button Delete -->
                        <form action="#" method="POST" class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                            <button type="submit"
                                class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-admin.layout>
