@extends('layouts.admin')
@section('content')

<div class="container mt-5">
  <div class="card shadow-lg p-4">
    <h3 class="text-center mb-4">Create User</h3>

    <form action="{{ route('backend.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

      <div class="mb-3">
        <label class="form-label">User Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Profile</label>
        <input type="file" class="form-control" name="profile">
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
      </div>

      <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select">
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="super admin">Super Admin</option>
        </select>
      </div>

      <div class="text-center">
        <button class="btn btn-primary px-4" type="submit">Create User</button>
      </div>

    </form>
  </div>
</div>

@endsection
