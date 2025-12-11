@extends('layout.main')

@section("content")
<style>
    .content-wrapper {
            min-height: calc(100vh - 80px); /* Adjust the 80px based on your navbar height */
            display: flex;
            align-items: center;
            padding-top: 5rem; /* Ensures space after navbar */
            padding-bottom: 2rem;
        }
</style>

<div class="content-wrapper">
    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <h4>Penalties</h4>
            </div>
            
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Return Deadline</th>
                            <th>Return Date</th>
                            <th>Penalty Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penalties as $penalty)
                        <tr>
                            <td>{{ $penalty->id }}</td>
                            <td>{{ $penalty->borrowRecord->book->title }}</td>
                            <td>{{ $penalty->borrowRecord->end_date }}</td>
                            <td>{{ $penalty->borrowRecord->return_date }}</td>
                            <td>{{ $penalty->amount }}</td>
                            <td>{{ $penalty->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection