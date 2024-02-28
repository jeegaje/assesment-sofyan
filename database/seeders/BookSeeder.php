<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Books::create([
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'publisher' => 'J. B. Lippincott & Co.',
            'category_id' => 1,
            'stock' => 20,
        ]);

        Books::create([
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'publisher' => 'Chilton Bookss',
            'category_id' => 2,
            'stock' => 15,
        ]);

        Books::create([
            'title' => 'The Hobbit',
            'author' => 'J.R.R. Tolkien',
            'publisher' => 'George Allen & Unwin',
            'category_id' => 3,
            'stock' => 18,
        ]);

        Books::create([
            'title' => 'The Girl with the Dragon Tattoo',
            'author' => 'Stieg Larsson',
            'publisher' => 'Norstedts Förlag',
            'category_id' => 5,
            'stock' => 12,
        ]);

        Books::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'publisher' => 'T. Egerton, Whitehall',
            'category_id' => 5,
            'stock' => 25,
        ]);
    }
}
