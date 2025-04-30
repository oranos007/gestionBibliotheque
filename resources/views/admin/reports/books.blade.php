@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Books Report</h2>
        <div class="btn-group">
            <a href="{{ route('reports.books') }}?type=popular" class="btn btn-outline-primary">Most Popular</a>
            <a href="{{ route('reports.books') }}?type=available" class="btn btn-outline-success">Available</a>
            <a href="{{ route('reports.books') }}?type=all" class="btn btn-outline-info">All Books</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Total Borrows</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author1 }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->category }}</td>
                            <td>{{ $book->borrows_count ?? 0 }}</td>
                            <td>
                                <span class="badge bg-{{ $book->available ? 'success' : 'danger' }}">
                                    {{ $book->available ? 'Yes' : 'No' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No books found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection