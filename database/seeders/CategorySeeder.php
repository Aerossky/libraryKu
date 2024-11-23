<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data kategori yang akan dimasukkan ke tabel categories
        $categories = [
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science'],
            ['name' => 'Technology'],
            ['name' => 'History'],
            ['name' => 'Biography'],
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Horror'],
        ];

        // Insert kategori ke dalam tabel categories
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
