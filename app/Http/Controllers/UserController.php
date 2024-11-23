<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari input
        $search = $request->input('search');

        // Query dengan filter pencarian
        $users = User::select('id', 'name', 'email', 'phone', 'role', 'user_image')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        // Tambahkan parameter pencarian ke pagination agar tetap ada di setiap halaman
        $users->appends(['search' => $search]);

        return view('admin.user.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'string|max:100|required',
            'email' => 'string|required|email',
            'phone' => 'string|max:20|required',
            'role' => 'required|in:admin,member',
            'user_image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
            'password' => 'required',
        ]);

        // Proses upload user image jika ada
        $userImagePath = $this->handleUserImageUpload($request);

        // Simpan data user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'user_image' => $userImagePath ?? null, // Jika ada, simpan path gambar
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $user = User::find($id);

        // jika user tidak ditemukan
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan');
        }

        return view('admin.user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan');
        }

        // Validasi input
        $request->validate([
            'name' => 'string|max:100|required',
            'email' => 'string|required|email|unique:users,email,' . $user->id, // Email harus unik kecuali milik user saat ini
            'phone' => 'string|max:20|required',
            'role' => 'required|in:admin,member',
            'password' => 'nullable|min:8', // Validasi password hanya jika diisi
            'user_image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
        ]);

        // Jika password diisi, lakukan hash
        $password = $request->password ? bcrypt($request->password) : $user->password;

        // Jika user image diisi, lakukan hapus image lama
        if ($request->hasFile('user_image')) {
            Storage::disk('public')->delete($user->user_image);
        }

        // Proses upload user image jika ada
        $userImagePath = $this->handleUserImageUpload($request, $user);

        // Simpan data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => $password,
            'user_image' => $userImagePath ?? $user->user_image,
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan');
        }

        // Hapus gambar user jika ada
        if ($user->user_image) {
            Storage::disk('public')->delete($user->user_image);
        }

        // Hapus user
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

    private function handleUserImageUpload($request)
    {
        if ($request->hasFile('user_image')) {
            // Ambil file yang di-upload
            $coverImage = $request->file('user_image');

            // Generate nama file unik
            $fileName = uniqid() . time() . '.' . $coverImage->getClientOriginalExtension();

            // Tentukan folder penyimpanan
            $folder = 'user';

            // Simpan file ke disk public dan kembalikan path
            return $coverImage->storeAs($folder, $fileName, 'public');
        }

        return null; // Jika tidak ada file, kembalikan null
    }
}
