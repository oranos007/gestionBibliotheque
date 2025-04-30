<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index(Request $request)
    {
        $query = Book::query();
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('author1', 'like', "%$search%")
                  ->orWhere('isbn', 'like', "%$search%");
            });
        }
        
        // Category filter
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        // Availability filter
        if ($request->has('available')) {
            $query->where('available', $request->available);
        }
        
        $books = $query->paginate(10);
        $categories = Book::select('category')->distinct()->pluck('category');
        
        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'isbn' => 'required|unique:books|max:20',
            'title' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'quantity' => 'required|integer|min:1',
            'category' => 'required|max:255',
            'volume' => 'nullable|max:50',
            'author1' => 'required|max:255',
            'author2' => 'nullable|max:255',
            'author3' => 'nullable|max:255',
            'author4' => 'nullable|max:255',
        ]);

        $validated['available'] = $validated['quantity'] > 0;
        
        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'isbn' => 'required|max:20|unique:books,isbn,'.$book->id,
            'title' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'quantity' => 'required|integer|min:0',
            'category' => 'required|max:255',
            'volume' => 'nullable|max:50',
            'author1' => 'required|max:255',
            'author2' => 'nullable|max:255',
            'author3' => 'nullable|max:255',
            'author4' => 'nullable|max:255',
        ]);

        $validated['available'] = $validated['quantity'] > 0;
        
        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        
        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}