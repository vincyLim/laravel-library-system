@extends('layout.admin')

@section("content")
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Penalties</h4>
            </div>
            
            <div class="card-body">
                <!-- Navigation tabs -->
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('penalty/unpaid*') ? 'active' : '' }}" href="{{ route('penalty.show',"unpaid") }}">Unpaid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('penalty/paid*') ? 'active' : '' }}" href="{{ route('penalty.show',"paid") }}">Paid</a>
                    </li>
                </ul>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Borrower Name</th>
                            <th>Return Date</th>
                            <th>Penalty Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penalties as $penalty)
                        <tr>
                            <td>{{ $penalty->id }}</td>
                            <td>{{ $penalty->borrowRecord->book->title }}</td>
                            <td>{{ $penalty->borrowRecord->user->name }}</td>
                            <td>{{ $penalty->borrowRecord->return_date }}</td>
                            <td>{{ $penalty->amount }}</td>
                            <td>
                                @can("payPenalty", App\Models\Penalty::class)
                                @if (!$penalty->isPaid())
                                <a href="{{ route('penalty.pay', $penalty->id) }}" class="btn btn-primary">Pay</a>
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