<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

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



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
