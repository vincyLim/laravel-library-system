<!-- @extends('layout.admin') -->
@section("content")

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>roles</h4>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>     
                                @can('update', $role)                           
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                                @endcan

                                @can('delete', $role)
                                <form action="{{ route('role.delete', $role->id) }}" method="POST" style="display:inline;">
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

                @can('create', App\Models\Role::class)
                <a href="{{ route('role.create') }}" class="btn btn-success w-100">Create</a>
                @endcan
            </div>

        </div>

        

    </div>
@endsection

