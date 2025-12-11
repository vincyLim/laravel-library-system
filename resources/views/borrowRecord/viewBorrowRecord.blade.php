@extends('layout.admin')

@section("content")
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Borrow Records</h4>
            </div>
            
            <div class="card-body">
                <!-- Navigation tabs -->
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('borrowRecord/requesting*') ? 'active' : '' }}" href="{{ route('borrowRecord.requesting') }}">Requesting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('borrowRecord/borrowing*') ? 'active' : '' }}" href="{{ route('borrowRecord.borrowing') }}">Borrowing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('borrowRecord/returned*') ? 'active' : '' }}" href="{{ route('borrowRecord.returned') }}">Returned</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('borrowRecord/overdue*') ? 'active' : '' }}" href="{{ route('borrowRecord.overdue') }}">Overdue</a>
                    </li>
                </ul>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Borrower Name</th>
                            <th>Borrow Deadline</th>
                            <th>Return Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowRecords as $borrowRecord)
                        <tr>
                            <td>{{ $borrowRecord->id }}</td>
                            <td>{{ $borrowRecord->book->title }}</td>
                            <td>
                                {{$borrowRecord->user->name}}
                            </td>                            
                            <td>
                                {{ $borrowRecord->end_date ?? '-' }}
                            </td>
                            <td>
                                {{ $borrowRecord->return_date ?? '-' }}
                            </td>
                            <td>
                                @can('approve_borrow_and_return_book', App\Models\BorrowRecord::class)
                                @if ($borrowRecord->isRequested())
                                <a href="{{ route('approveRequest', $borrowRecord->id) }}" class="btn btn-success">Approve</a>
                                @endif
                                @if ($borrowRecord->isBorrowed())
                                <a href="{{ route('returnBook', $borrowRecord->id) }}" class="btn btn-warning">Return</a>
                                @endif
                                @if ($borrowRecord->isOverdue()&& !$borrowRecord->isPenaltyPaid())
                                <a href="{{ route('penalty.pay', $borrowRecord->penalty->id) }}" class="btn btn-warning">Pay Penalty</a>
                                @endif
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection