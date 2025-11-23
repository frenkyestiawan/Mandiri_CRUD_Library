<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laravel untuk Pemula',
                'author' => 'Tim Laravel',
                'category' => 'Pemrograman',
                'publisher' => 'Penerbit Laravel',
                'stock' => 5,
                'published_year' => 2024,
                'description' => 'Buku pengantar framework Laravel.',
                'cover' => 'covers/laravel-pemula.jpg',
            ],
            [
                'title' => 'Dasar-dasar PHP',
                'author' => 'John Doe',
                'category' => 'Pemrograman',
                'publisher' => 'Penerbit PHP',
                'stock' => 3,
                'published_year' => 2022,
                'description' => 'Belajar dasar bahasa pemrograman PHP.',
                'cover' => 'covers/php-dasar.jpg',
            ],
            [
                'title' => 'Basis Data MySQL',
                'author' => 'Jane Smith',
                'category' => 'Database',
                'publisher' => 'Penerbit MySQL',
                'stock' => 4,
                'published_year' => 2021,
                'description' => 'Konsep dasar dan praktik MySQL.',
                'cover' => 'covers/mysql-basis-data.jpg',
            ],
        ];

        foreach ($books as $data) {
            Book::firstOrCreate(
                [
                    'title' => $data['title'],
                    'author' => $data['author'],
                ],
                $data
            );
        }
    }
}
