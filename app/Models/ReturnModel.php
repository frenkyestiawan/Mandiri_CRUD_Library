<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    use HasFactory;

    protected $table = 'returns';

    protected $fillable = [
        'loan_id',
        'status',
        'requested_at',
        'approved_at',
        'is_late',
        'penalty_note',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'is_late' => 'boolean',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
