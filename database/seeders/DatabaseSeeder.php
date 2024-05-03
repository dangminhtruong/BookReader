<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use App\Models\AuthorBook;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Publisher::factory(5)->create();
        Author::factory(20)->create();
        Book::factory(200)->create()->each(function(Book $book) {
            $author = Author::select('id')->inRandomOrder()->first();

            AuthorBook::factory()
                ->count(1)
                ->create([
                    'author_id' => $author->id,
                    'book_id' => $book->id,
                ]);
        });
    }
}
