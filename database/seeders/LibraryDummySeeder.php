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
        $books = Book::factory()->count(10)->create();

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('Admin');

        $members = collect();
        for ($i = 1; $i <= 5; $i++) {
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

        // 5 pending loans
        for ($i = 0; $i < 5; $i++) {
            Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $books[$i % $books->count()]->id,
                'status' => 'pending',
            ]);
        }

        // 5 approved loans
        for ($i = 5; $i < 10; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(0, 6));
            $dueAt = (clone $borrowedAt)->addDays(7);

            Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $books[$i % $books->count()]->id,
                'status' => 'approved',
                'borrowed_at' => $borrowedAt,
                'due_at' => $dueAt,
            ]);
        }

        // 5 returned on time
        for ($i = 10; $i < 15; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(8, 20));
            $dueAt = (clone $borrowedAt)->addDays(7);
            $returnedAt = (clone $dueAt)->subDays(rand(0, 2));

            $loan = Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $books[$i % $books->count()]->id,
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

        // 5 returned late
        for ($i = 15; $i < 20; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(10, 25));
            $dueAt = (clone $borrowedAt)->addDays(7);
            $returnedAt = (clone $dueAt)->addDays(rand(1, 5));
            $daysLate = $dueAt->diffInDays($returnedAt);

            $loan = Loan::factory()->create([
                'user_id' => $members[$i % $members->count()]->id,
                'book_id' => $books[$i % $books->count()]->id,
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
