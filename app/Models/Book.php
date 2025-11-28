<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover',
        'title',
        'author',
        'category',
        'publisher',
        'stock',
        'published_year',
        'description',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
