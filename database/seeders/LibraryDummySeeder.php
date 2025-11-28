<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\ReturnModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LibraryDummySeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all()->values();

        if ($books->isEmpty()) {
            return;
        }

        $bookDistribution = [
            0, 0, 0, 0, 0,
            1, 1, 1,
            2, 2,
            3, 4, 5, 6, 7, 8,
            9, 9, 9, 9,
        ];

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('Admin');

        $members = collect();
        for ($i = 1; $i <= 8; $i++) {
            $member = User::firstOrCreate(
                ['email' => "member{$i}@example.com"],
                [
                    'name' => "Anggota {$i}",
                    'password' => bcrypt('password'),
                ]
            );
            $member->assignRole('Anggota');
            $members->push($member);
        }

        $members = $members->shuffle();
        $books = $books->shuffle();

        for ($i = 0; $i < 5; $i++) {
            $bookIndex = $bookDistribution[$i] ?? 0;
            $book = $books[$bookIndex % $books->count()];

            Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $book->id,
                'status' => 'pending',
            ]);
        }

        for ($i = 5; $i < 10; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(0, 6));
            $dueAt = (clone $borrowedAt)->addDays(7);

            $bookIndex = $bookDistribution[$i] ?? 0;
            $book = $books[$bookIndex % $books->count()];

            $loan = Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $book->id,
                'status' => 'approved',
                'borrowed_at' => $borrowedAt,
                'due_at' => $dueAt,
            ]);

            if ($i < 8) {
                ReturnModel::factory()->create([
                    'loan_id' => $loan->id,
                    'status' => 'pending',
                    'requested_at' => Carbon::now()->subDays(rand(0, 2)),
                ]);
            }
        }

        for ($i = 10; $i < 14; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(8, 20));
            $dueAt = (clone $borrowedAt)->addDays(7);
            $returnedAt = (clone $dueAt)->subDays(rand(0, 2));

            $bookIndex = $bookDistribution[$i] ?? 0;
            $book = $books[$bookIndex % $books->count()];

            $loan = Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $book->id,
                'status' => 'returned',
                'borrowed_at' => $borrowedAt,
                'due_at' => $dueAt,
                'returned_at' => $returnedAt,
                'is_late' => false,
                'penalty_note' => null,
            ]);

            ReturnModel::factory()->create([
                'loan_id' => $loan->id,
                'status' => 'approved',
                'requested_at' => (clone $returnedAt)->subDays(1),
                'approved_at' => $returnedAt,
                'is_late' => false,
                'penalty_note' => null,
            ]);
        }

        for ($i = 15; $i < 20; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(10, 25));
            $dueAt = (clone $borrowedAt)->addDays(7);
            $returnedAt = (clone $dueAt)->addDays(rand(1, 5));
            $daysLate = $dueAt->diffInDays($returnedAt);

            $bookIndex = $bookDistribution[$i] ?? 0;
            $book = $books[$bookIndex % $books->count()];

            $loan = Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $book->id,
                'status' => 'returned',
                'borrowed_at' => $borrowedAt,
                'due_at' => $dueAt,
                'returned_at' => $returnedAt,
                'is_late' => true,
                'penalty_note' => 'Terlambat '.$daysLate.' hari',
            ]);

            ReturnModel::factory()->create([
                'loan_id' => $loan->id,
                'status' => 'approved',
                'requested_at' => (clone $returnedAt)->subDays(1),
                'approved_at' => $returnedAt,
                'is_late' => true,
                'penalty_note' => 'Terlambat '.$daysLate.' hari',
            ]);
        }
    }
}
