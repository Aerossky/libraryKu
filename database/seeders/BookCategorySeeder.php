<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $books = Book::all();
        $categories = Category::all();

        foreach ($books as $book) {
            // attach kategori 1 ke semua buku
            $book->categories()->attach(
                $categories->random(1)->pluck('id')->toArray()
            );
        }
    }
}
