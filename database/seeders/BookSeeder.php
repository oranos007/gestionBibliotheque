<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'isbn' => '9783161484100', // ✅ REQUIRED FIELD
            'title' => 'Sample Biography',
            'publisher' => 'Penguin Books',
            'year' => 2020,
            'quantity' => 5,
            'category' => 'Biography',
            'volume' => null,
            'author1' => 'John Doe',
            'author2' => null,
            'author3' => null,
            'author4' => null,
            'available' => true,
        ]);

        // Add more books if needed
    }
}