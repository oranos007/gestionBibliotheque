<table class="table table-striped">
    <thead>
        <tr>
            <th>Book</th>
            <th>Borrower</th>
            <th>Due Date</th>
            <th>Days Overdue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($overdueBooks as $borrow)
        <tr>
            <td>{{ $borrow->book->title }}</td>
            <td>{{ $borrow->user->name }}</td>
            <td>{{ $borrow->return_date->format('Y-m-d') }}</td>
            <td>{{ now()->diffInDays($borrow->return_date) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>