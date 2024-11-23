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
            $table->string('title', 100)->required();
            $table->string('author', 100)->required();
            $table->string('publisher', 100)->required();
            $table->date('published_date')->required();
            $table->string('isbn', 20)->unique()->required();
            $table->string('language', 20)->nullable();
            $table->text('description')->required();
            $table->string('cover_image')->required();
            // relationship with users table (borrowed_by)
            $table->foreignId('borrowed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('borrowed_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
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
