<?php

namespace Database\Seeders;

use App\Models\BookCategories;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookCategories::create([
            'name' => 'Fiction',
        ]);

        BookCategories::create([
            'name' => 'Science Fiction',
        ]);

        BookCategories::create([
            'name' => 'Fantasy',
        ]);

        BookCategories::create([
            'name' => 'Mystery',
        ]);

        BookCategories::create([
            'name' => 'Thriller',
        ]);

        BookCategories::create([
            'name' => 'Romance',
        ]);

        BookCategories::create([
            'name' => 'Horror',
        ]);

        BookCategories::create([
            'name' => 'Biography',
        ]);

        BookCategories::create([
            'name' => 'History',
        ]);

        BookCategories::create([
            'name' => 'Self-Help',
        ]);
    }
}
