@extends('layout.admin')

@section("content")
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Permission</h4>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            {{-- <td>
                                <a href="{{route('permission.edit', $permission->id)}}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('permission.delete', $permission->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>

                </table>

{{--                 @can('create', App\Models\Permission::class)
                <a href="{{route('permission.create')}}" class="btn btn-success w-100">Create</a>
                @endcan
 --}}
            </div>

        </div>

        

    </div>
@endsection
