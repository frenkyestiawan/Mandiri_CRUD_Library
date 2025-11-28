<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement([
                'Fiksi',
                'Non-Fiksi',
                'Pendidikan / Akademik',
                'Teknologi & Komputer',
                'Bisnis & Ekonomi',
                'Seni & Desain',
                'Kesehatan & Kedokteran',
                'Agama',
                'Anak & Remaja',
                'Sejarah & Budaya',
            ]),
            'publisher' => $this->faker->randomElement(['Penerbit A', 'Penerbit B', 'Penerbit C', 'Penerbit D', 'Penerbit E']),
            'stock' => $this->faker->numberBetween(1, 10),
            'published_year' => $this->faker->numberBetween(2000, 2024),
            'description' => $this->faker->paragraph(),
        ];
    }
}
