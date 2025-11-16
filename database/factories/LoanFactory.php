<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'book_id' => null,
            'status' => 'pending',
            'borrowed_at' => null,
            'due_at' => null,
            'returned_at' => null,
            'is_late' => false,
            'penalty_note' => null,
        ];
    }
}
