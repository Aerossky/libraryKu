<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari input
        $search = $request->input('search');

        // Query dengan filter pencarian
        $books = Book::select('id', 'title', 'author', 'publisher', 'isbn', 'cover_image')
            ->with('categories')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('publisher', 'like', '%' . $search . '%')
                    ->orWhere('isbn', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        // Tambahkan parameter pencarian ke pagination agar tetap ada di setiap halaman
        $books->appends(['search' => $search]);

        return view('admin.book.index', compact('books', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::select('id', 'name')->get();
        return view('admin.book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|min:3|max:50|required',
            'author' => 'string|max:255|required',
            'publisher' => 'string|max:255|required',
            'published_date' => 'date|required',
            'isbn' => 'string|max:20|required',
            'language' => 'string|max:20|required',
            'description' => 'string|required',
            'categories' => 'array|required',
            'cover_image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
        ]);

        // Proses upload cover image jika ada
        $coverImagePath = $this->handleCoverImageUpload($request);

        // Simpan data buku
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'published_date' => $request->published_date,
            'isbn' => $request->isbn,
            'language' => $request->language,
            'description' => $request->description,
            'cover_image' => $coverImagePath ?? null, // Jika ada, simpan path gambar
        ]);

        // Simpan relasi kategori
        $book->categories()->attach($request->categories);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('book.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::with('categories')->with('categories')->find($id);

        // Jika buku tidak ditemukan, redirect ke halaman daftar buku
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }

        return view('admin.book.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Menggunakan 'with' sebelum 'find' agar relasi dimuat dengan benar
        $book = Book::with('categories')->find($id);
        $categories = Category::select('id', 'name')->get();


        // Jika buku tidak ditemukan, redirect ke halaman daftar buku
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }

        return view('admin.book.update', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        // Validasi input
        $request->validate([
            'title' => 'string|min:3|max:50|required',
            'author' => 'string|max:255|required',
            'publisher' => 'string|max:255|required',
            'published_date' => 'date|required',
            'isbn' => 'string|max:20|required',
            'language' => 'string|max:20|required',
            'description' => 'string|required',
            'categories' => 'array|required',
            'cover_image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',
        ]);

        // Proses hapus cover image lama jika ada cover image baru
        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($book->cover_image);
        }

        // Proses upload cover image jika ada
        $coverImagePath = $this->handleCoverImageUpload($request);


        // Simpan data buku
        Book::where('id', $id)->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'published_date' => $request->published_date,
            'isbn' => $request->isbn,
            'language' => $request->language,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
        ]);

        // Sync kategori
        $book->categories()->sync($request->categories);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('book.index')->with('success', 'Buku berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::find($id);

        // Jika buku tidak ditemukan, redirect ke halaman daftar buku
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }

        // Hapus cover image jika ada
        if ($book->cover_image) {
            // Hapus file menggunakan disk public
            Storage::disk('public')->delete($book->cover_image);
        }

        // Hapus relasi kategori
        $book->categories()->detach();

        // Hapus buku
        $book->delete();

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('book.index')->with('success', 'Buku berhasil dihapus');
    }

    public function borrowed(Request $request)
    {
        $userId = $request->input('user_id');

        // Ambil buku yang sudah dipinjam dan statusnya
        $books = Book::with(['user'])
            ->when($userId, function ($query, $userId) {
                return $query->where('borrowed_by', $userId);
            })
            ->whereNotNull('borrowed_by')  // Hanya yang sudah dipinjam
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::orderBy('name')->get();

        return view('admin.borrow.index', compact('books', 'users'));
    }



    public function editStatus($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit-status', compact('book'));
    }

    public function updateStatus(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $book->status = $request->status;

        if ($request->status === 'rejected') {
            $book->borrowed_by = NULL;
            $book->status = 'pending';
        }

        $book->save();

        return redirect()->route('books.borrowed')->with('success', 'Status berhasil diperbarui.');
    }

    private function handleCoverImageUpload($request)
    {
        if ($request->hasFile('cover_image')) {
            // Ambil file yang di-upload
            $coverImage = $request->file('cover_image');

            // Generate nama file unik
            $fileName = uniqid() . time() . '.' . $coverImage->getClientOriginalExtension();

            // Tentukan folder penyimpanan
            $folder = 'book';

            // Simpan file ke disk public dan kembalikan path
            return $coverImage->storeAs($folder, $fileName, 'public');
        }

        return null; // Jika tidak ada file, kembalikan null
    }
}
