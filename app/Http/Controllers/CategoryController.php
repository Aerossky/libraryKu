<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari input
        $search = $request->input('search');

        // Query data kategori dengan pencarian
        $categories = Category::select('id', 'name')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Batasi 10 item per halaman

        // Tambahkan parameter pencarian ke pagination agar tetap ada
        $categories->appends(['search' => $search]);

        return view('admin.category.index', compact('categories', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::find($id);

        // ambil buku yang terkait dengan kategori
        $books = $category->books()->get();

        return view('admin.category.detail', compact('category', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::find($id);

        // Jika kategori tidak ditemukan, redirect ke halaman daftar kategori
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Kategori tidak ditemukan.');
        }

        return view('admin.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::findOrFail($id);

        // jika kategori tidak ditemukan, redirect ke halaman daftar kategori
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Kategori tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data buku
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);

        // jika kategori tidak ditemukan, redirect ke halaman daftar kategori
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Kategori tidak ditemukan.');
        }

        // Hapus kategori
        $category->delete();

        // sync relasi kategori pada buku
        $category->books()->detach();

        return redirect()->route('category.index')->with('success', 'Kategori sukses dihapus.');
    }
}
