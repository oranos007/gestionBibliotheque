<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'returned'
    ];

    protected $dates = [
        'borrow_date',
        'return_date',
        'actual_return_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }


    // app/Models/Borrow.php
protected $casts = [
    'borrow_date' => 'date',
    'return_date' => 'date',
    'actual_return_date' => 'date',
];
}