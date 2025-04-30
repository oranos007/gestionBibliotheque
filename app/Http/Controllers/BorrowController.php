<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('borrows.index', compact('borrows'));
    

    $borrows = Auth::user()
        ->borrows()
        ->with('book')
        ->orderBy('created_at', 'desc')
        ->get(); // Changed from paginate() to get() for simplicity

    return view('borrows.index', compact('borrows'));
}

    public function borrow(Book $book)
    {
        if (!$book->available) {
            return back()->with('error', 'This book is not available for borrowing.');
        }

        if (auth()->user()->borrows()->where('book_id', $book->id)->where('returned', false)->exists()) {
            return back()->with('error', 'You have already borrowed this book.');
        }

        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_date' => now()->addDays(14),
        ]);

        $book->decrement('quantity');
        if ($book->quantity <= 0) {
            $book->update(['available' => false]);
        }

        return back()->with('success', 'Book borrowed successfully.');
    }

    public function return(Borrow $borrow)
    {
        if ($borrow->user_id !== auth()->id()) {
            abort(403);
        }

        $borrow->update([
            'actual_return_date' => now(),
            'returned' => true,
        ]);

        $book = $borrow->book;
        $book->increment('quantity');
        $book->update(['available' => true]);

        return back()->with('success', 'Book returned successfully.');
    }

    public function history()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('borrows.history', compact('borrows'));
    }
}