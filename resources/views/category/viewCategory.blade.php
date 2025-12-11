@extends('layout.admin')

@section("content")
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Genre</h4>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Genre</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if ($category->icon)
                                    <img src="{{ asset("storage/".$category->icon) }}" alt="Category Icon" class="img-thumbnail" width="40">
                                @endif
                            </td>
                            <td>
                                @can('update', App\Models\Category::class)
                                <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary">Edit</a>
                                @endcan

                                @can('delete', App\Models\Category::class)
                                <form action="{{ route('category.delete', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                @can('create', App\Models\Category::class)
                <a href="{{route('category.create')}}" class="btn btn-success w-100">Create</a>
                @endcan

            </div>
        </div>



    </div>
@endsection
