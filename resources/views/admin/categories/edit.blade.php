@extends('layouts.admin')
@section('content')


<div class="container mt-5">
  <div class="card shadow-lg p-4">
    <h3 class="text-center mb-4">Edit Category</h3>
    <a href="{{route('backend.categories.index')}}" class="btn btn-danger flat end">Cancel</a>
   <form action="{{ route('backend.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

      
      <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$category->name}}" >
        @error('name')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-category" role="presentation">
            <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Image</button>
          </li>
          <li class="nav-category" role="presentation">
            <button class="nav-link" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">New Image</button>
          </li>
          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
            <img src="{{$category->image}}" class="w-25 h-25 my-2" alt="">
            <input type="hidden" name="old_image" id="" value="{{$category->image}}">
          </div>
          <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab" tabindex="0">
             <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
          </div>
        </div>
          {{-- <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
        @error('image')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror --}}
      </div>

      <div class="text-center">
       <button type="submit" class="btn btn-warning px-4">Update</button>
      </div>
    </form>
  </div>
</div>


@endsection