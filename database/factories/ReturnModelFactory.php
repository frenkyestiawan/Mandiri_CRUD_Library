<?php

namespace Database\Factories;

use App\Models\ReturnModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReturnModel>
 */
class ReturnModelFactory extends Factory
{
    protected $model = ReturnModel::class;

    public function definition(): array
    {
        return [
            'loan_id' => null,
            'status' => 'pending',
            'requested_at' => null,
            'approved_at' => null,
            'is_late' => false,
            'penalty_note' => null,
        ];
    }
}
