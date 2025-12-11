<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Session\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(10)->create()->each(function ($book) {
            $filename = 'cover_' . Str::uuid() . '.jpeg';

            $coverPath = public_path("book_covers/cover.jpeg");
            Storage::disk('public')->put("book_covers/{$filename}", file_get_contents($coverPath));

            $book->book_cover = "book_covers/{$filename}";
            $book->save();

            $book->authors()->attach(rand(1,10)); // Assuming you have 5 authors
            $book->categories()->attach(rand(1,5)); // Assuming you have 5 categories
        });
    }
}
