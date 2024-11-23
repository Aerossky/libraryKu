<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'published_date',
        'isbn',
        'language',
        'description',
        'cover_image',
        'borrowed_by',
        'borrowed_at',
    ];


    /**
     * The user that borrowed the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'borrowed_by');
    }

    /**
     * Get the categories associated with the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
}
