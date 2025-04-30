<?php
// app/Http/Controllers/Admin/ReportController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;

class ReportController extends Controller
{
    public function books()
    {
        $books = Book::withCount('borrows')
                   ->orderBy('borrows_count', 'desc')
                   ->paginate(10);
                   
        return view('admin.reports.books', compact('books'));
    }
}