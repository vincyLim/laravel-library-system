@extends('layout.admin')

@section("content")
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Users</h4>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                @can("update", $user)
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                @endcan
                                
                                @can("delete", $user)
                                <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;">
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
                
                @can('create', App\Models\User::class)
                <a href="{{ route('user.create') }}" class="btn btn-success w-100">Create</a>
                @endcan
            </div>

            

        </div>

    </div>
@endsection

