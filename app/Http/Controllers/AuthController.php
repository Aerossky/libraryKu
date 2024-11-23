<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100|required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'string|max:20|required',
            'user_image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
            'password' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses upload user image jika ada
        $userImagePath = $this->handleUserImageUpload($request);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'member',
            'user_image' => $userImagePath,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('home'); // Ganti dengan rute yang sesuai
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil
            return redirect()->intended('/'); // Ganti dengan rute yang sesuai
        }

        // Jika login gagal
        return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
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
