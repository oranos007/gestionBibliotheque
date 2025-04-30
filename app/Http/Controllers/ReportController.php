<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    /**
     * Show books report
     */
    public function books(Request $request)
    {
        $query = Book::withCount('borrows');
    
        switch ($request->sort) {
            case 'popular':
                $query->orderBy('borrows_count', 'desc');
                break;
            case 'available':
                $query->where('available', true)
                      ->orderBy('title');
                break;
            default:
                $query->orderBy('title');
        }
    
        return view('reports.books', [
            'books' => $query->paginate(10)
        ]);
    }
}