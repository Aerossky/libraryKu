<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('public.index');
    }
    public function book(Request $request)
    {
        // Ambil parameter pencarian dan filter kategori
        $search = $request->input('search');
        $categoryFilter = $request->input('category');

        // Query untuk mengambil buku
        $query = Book::query();

        // Jika ada pencarian berdasarkan judul, penulis, atau penerbit
        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('publisher', 'like', "%{$search}%");
        }

        // Jika ada filter berdasarkan kategori
        if ($categoryFilter) {
            $query->whereHas('categories', function ($q) use ($categoryFilter) {
                $q->where('name', $categoryFilter);
            });
        }

        // Hanya tampilkan buku yang belum dipinjam (borrowed_by adalah null)
        $query->whereNull('borrowed_by');  // Filter buku yang belum dipinjam

        // Ambil data buku dengan pagination
        $books = $query->paginate(6);

        // Ambil semua kategori untuk filter
        $categories = Category::all();

        return view('public.buku', compact('books', 'categories', 'search', 'categoryFilter'));
    }

    public function borrowed()
    {
        $books = Book::where('borrowed_by', Auth::user()->id)->paginate(6);
        $categories = Category::all();
        return view('public.pinjaman', compact('books', 'categories'));
    }

    public function borrow(string $id)
    {
        // Ambil data buku yang akan dipinjam
        $book = Book::findOrFail($id);

        // Simpan id user yang meminjam buku
        $book->borrowed_by = Auth::user()->id;
        $book->borrowed_at = now();
        $book->save();

        return redirect()->back();
    }
}
