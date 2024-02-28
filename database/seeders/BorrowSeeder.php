<?php

namespace Database\Seeders;

use App\Models\Borrows;
use Illuminate\Database\Seeder;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Borrows::create([
            'member_id' => 1,
            'book_id' => 1,
            'borrow_date' => now()->subDays(10),
            'return_date' => now()->subDays(2),
        ]);

        Borrows::create([
            'member_id' => 2,
            'book_id' => 2,
            'borrow_date' => now()->subDays(5),
            'return_date' => null, // Buku ini belum dikembalikan
        ]);

        Borrows::create([
            'member_id' => 3,
            'book_id' => 3,
            'borrow_date' => now()->subDays(3),
            'return_date' => now()->subDays(1),
        ]);
    }
}
