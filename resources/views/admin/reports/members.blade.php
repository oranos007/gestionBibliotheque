<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Total Borrows</th>
            <th>Current Borrows</th>
            <th>Overdue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->total_borrows }}</td>
            <td>{{ $member->current_borrows }}</td>
            <td>{{ $member->overdue_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>