<x-admin.layout>

    {{-- Title --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Peminjaman</h1>
    </div>

    {{-- Filter --}}
    <div class="mb-4">
        <form action="{{ route('books.borrowed') }}" method="GET" class="flex items-center space-x-2">
            <select name="user_id" class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                <option value="">Semua Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Filter
            </button>
        </form>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-200 text-green-700 border border-green-300 px-3 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-200 text-red-700 border border-red-300 px-3 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif


    {{-- Table --}}
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center">
        <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">No</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Title</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Author</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">User</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @if ($books->isEmpty())
                <tr>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="6">
                        Tidak Ada Data
                    </td>
                </tr>
            @endif

            @foreach ($books as $data)
                <tr>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $loop->iteration }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->title }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->author }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        {{-- Dropdown untuk mengubah status --}}
                        <form action="{{ route('books.updateStatus', $data->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
                                <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ $data->status == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ $data->status == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </form>
                    </td>
                    @if ($data->user->name)
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->user->name }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>


    {{-- Pagination --}}
    <div class="mt-4">
        {{-- {{ $books->links() }} --}}
    </div>

</x-admin.layout>
