@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Authors</h4>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>
                        @can("update",\App\Models\Author::class)
                        <a href="{{ route('author.edit', $author->id) }}" class="btn btn-primary">Edit</a>
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

