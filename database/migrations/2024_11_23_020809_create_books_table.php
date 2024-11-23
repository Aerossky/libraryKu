<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('author', 100);
            $table->string('publisher', 100);
            $table->date('published_date');
            $table->string('isbn', 20)->unique();
            $table->string('language', 20);
            $table->text('description');
            $table->string('cover_image');
            // relationship with users table (borrowed_by)
            $table->foreignId('borrowed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('borrowed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
