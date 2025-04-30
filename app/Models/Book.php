<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'publisher',
        'year',
        'quantity',
        'category',
        'volume',
        'author1',
        'author2',
        'author3',
        'author4',
        'available'
    ];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function getAvailabilityAttribute()
    {
        return $this->available ? 'Available' : 'Not Available';
    }
}