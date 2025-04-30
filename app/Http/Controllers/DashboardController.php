<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'available_books' => Book::where('available', true)->count(),
            'total_members' => User::where('role', 'user')->count(),
            'active_borrows' => Borrow::where('returned', false)->count(),
        ];

        $recent_borrows = Borrow::with(['user', 'book'])
            ->where('returned', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $popular_books = Book::withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_borrows', 'popular_books'));
    }
}