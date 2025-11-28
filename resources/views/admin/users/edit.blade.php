@extends('layouts.admin')
@section('content')

<div class="container mt-5">
  <div class="card shadow-lg p-4">
    <h3 class="text-center mb-4">Edit User</h3>

    <form action="{{ route('backend.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" class="form-control" name="name" 
                   value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" 
                   value="{{ old('phone', $user->phone) }}">
        </div>

        <!-- IMAGE TAB SYSTEM -->
        <div class="mb-3">
            <ul class="nav nav-tabs" id="imageTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="current-img-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#current-img-pane" 
                            type="button" role="tab">
                        Current Image
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="new-img-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#new-img-pane" 
                            type="button" role="tab">
                        New Image
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="imageTabContent">

                <!-- Current Image -->
                <div class="tab-pane fade show active" 
                     id="current-img-pane" role="tabpanel">

                    @if($user->profile)
                        <img src="{{ asset($user->profile) }}" 
                             class="img-fluid rounded mb-2" 
                             style="width:120px; height:120px; object-fit:cover;">
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif

                    <input type="hidden" name="old_image" value="{{ $user->profile }}">
                </div>

                <!-- Upload New Image -->
                <div class="tab-pane fade" id="new-img-pane" role="tabpanel">
                    <label class="form-label">Choose New Profile Image</label>
                    <input type="file" name="image" accept="image/*" 
                           class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" 
                   value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Password (Leave blank if not changing)</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="">Select Role</option>
                <option value="admin" 
                    {{ $user->role == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="super admin" 
                    {{ $user->role == 'super admin' ? 'selected' : '' }}>
                    Super Admin
                </option>
            </select>
        </div>

        <div class="text-center">
            <button class="btn btn-primary px-4" type="submit">Update User</button>
        </div>

    </form>
  </div>
</div>

@endsection
