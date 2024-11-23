<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data user yang ada (karena kolom borrowed_by berelasi dengan users)
        $userIds = User::pluck('id')->toArray();

        $data = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Charles Scribner\'s Sons',
                'published_date' => '1925-04-10',
                'isbn' => '9780743273565',
                'language' => 'English',
                'description' => 'A novel set in the Jazz Age that examines themes of decadence, idealism, resistance to change, social upheaval, and excess.',
                'cover_image' => 'great-gatsby.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'published_date' => '1949-06-08',
                'isbn' => '9780451524935',
                'language' => 'English',
                'description' => 'A dystopian novel that explores the dangers of totalitarianism, mass surveillance, and repressive regimentation of people and behavior.',
                'cover_image' => '1984.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'J.B. Lippincott & Co.',
                'published_date' => '1960-07-11',
                'isbn' => '9780061120084',
                'language' => 'English',
                'description' => 'A novel about racial injustice in the Deep South, focusing on the Finch family and their involvement in a court case involving a black man accused of raping a white woman.',
                'cover_image' => 'to-kill-a-mockingbird.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'publisher' => 'Little, Brown and Company',
                'published_date' => '1951-07-16',
                'isbn' => '9780316769488',
                'language' => 'English',
                'description' => 'The novel explores complex themes of identity, alienation, loss, and connection in a coming-of-age story of a disenchanted teenager.',
                'cover_image' => 'catcher-in-the-rye.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'publisher' => 'Chatto & Windus',
                'published_date' => '1932-08-01',
                'isbn' => '9780060850524',
                'language' => 'English',
                'description' => 'A dystopian novel about a future society that is technologically advanced but socially oppressive, where human freedom is sacrificed for stability.',
                'cover_image' => 'brave-new-world.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Moby-Dick',
                'author' => 'Herman Melville',
                'publisher' => 'Harper & Brothers',
                'published_date' => '1851-10-18',
                'isbn' => '9781503280786',
                'language' => 'English',
                'description' => 'The story of Ishmael’s voyage on the Pequod, a whaling ship led by the monomaniacal Captain Ahab in pursuit of the giant white whale Moby-Dick.',
                'cover_image' => 'moby-dick.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'George Allen & Unwin',
                'published_date' => '1937-09-21',
                'isbn' => '9780618968633',
                'language' => 'English',
                'description' => 'The prelude to the Lord of the Rings, focusing on Bilbo Baggins and his journey to reclaim treasure from the dragon Smaug.',
                'cover_image' => 'the-hobbit.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fahrenheit 451',
                'author' => 'Ray Bradbury',
                'publisher' => 'Ballantine Books',
                'published_date' => '1953-10-19',
                'isbn' => '9781451673319',
                'language' => 'English',
                'description' => 'A novel about a dystopian future where books are banned, and the protagonist is a fireman tasked with burning them.',
                'cover_image' => 'fahrenheit-451.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Crime and Punishment',
                'author' => 'Fyodor Dostoevsky',
                'publisher' => 'The Russian Messenger',
                'published_date' => '1866-01-01',
                'isbn' => '9780486415871',
                'language' => 'English',
                'description' => 'A psychological novel about the moral dilemmas faced by Rodion Raskolnikov, who commits a crime and struggles with guilt.',
                'cover_image' => 'crime-and-punishment.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'War and Peace',
                'author' => 'Leo Tolstoy',
                'publisher' => 'The Russian Messenger',
                'published_date' => '1869-01-01',
                'isbn' => '9781400079988',
                'language' => 'English',
                'description' => 'A sweeping epic about the Napoleonic Wars, focusing on the lives of Russian aristocrats and the philosophical musings of the characters.',
                'cover_image' => 'war-and-peace.jpg',
                'borrowed_by' => $userIds[array_rand($userIds)],
                'borrowed_at' => now(),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($data as $book) {
            // insert data ke pivot tabl
            Book::create($book);
        }
    }
}
