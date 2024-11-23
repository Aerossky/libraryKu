<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Ambil pengguna yang sedang login
        $user = Auth::user();

        // Pastikan ada pengguna yang sedang login
        if (!$user) {
            return redirect()->route('login');
        }

        // Cek apakah pengguna adalah admin
        if ($user->role == 'admin') {
            return $next($request); // Akses diizinkan
        }

        // Ambil ID pengguna dari route
        $userId = $request->route('pengguna');

        // Pastikan kita mendapatkan hanya ID (misalnya, dari objek pengguna)
        if (is_object($userId)) {
            $userId = $userId->id; // Ambil ID jika $userId adalah objek
        }

        // Pastikan dibandingkan ID-nya saja
        if ($user->id == (int)$userId) {
            return $next($request); // Akses diizinkan
        }

        // Jika tidak sesuai, redirect kembali
        return redirect()->back()->with('error', 'Akses tidak diizinkan');
    }
}
