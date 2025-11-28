@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="my-3">
        <h1 class="mt-4 d-inline">Users</h1>
        <a href="{{ route('backend.users.create') }}" class="btn btn-primary float-end">Create User</a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            User List
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $i++ }}</td>
                       <td>
                        @if($user->profile)
                            <img src="{{ asset($user->profile) }}" 
                                width="60" 
                                height="60" 
                                class="rounded-circle" 
                                alt="">
                        @else
                            <img src="{{ asset('images/default.png') }}" 
                                width="60" 
                                height="60" 
                                class="rounded-circle" 
                                alt="default">
                        @endif
                    </td>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>********</td>
                        <td>
                            <a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                           <button  class="btn btn-sm btn-danger delete" data-id="{{$user->id}}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5" id="deleteLabel">Delete User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this user?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
    $('tbody').on('click', '.delete', function(){
        let id = $(this).data('id');
        $('#deleteForm').attr('action', `users/${id}`);
        $('#deleteModal').modal('show');
    });
});
</script>
@endsection
