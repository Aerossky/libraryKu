<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::select('id', 'name')->get();
        return view('admin.category.index', compact('categories'));
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
    public function show(string $id) {}

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

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
