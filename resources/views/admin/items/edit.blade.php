@extends('layouts.admin')
@section('content')


<div class="container mt-5">
  <div class="card shadow-lg p-4">
    <h3 class="text-center mb-4">Edit Item</h3>
    <a href="{{route('backend.items.index')}}" class="btn btn-danger flat end">Cancel</a>
   <form action="{{route('backend.items.update',$item->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

      <div class="mb-3">
        <label for="code_no" class="form-label">Code No</label>
        <input type="text" class="form-control @error('code_no') is-invalid @enderror" id="code_no" name="code_no" value="{{$item->code_no}}" >
        @error('code_no')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Item Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$item->name}}" >
        @error('name')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Image</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">New Image</button>
          </li>
          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
            <img src="{{$item->image}}" class="w-25 h-25 my-2" alt="">
            <input type="hidden" name="old_image" id="" value="{{$item->image}}">
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
      
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{$item->price}}"  >
        @error('price')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="discount" class="form-label">Discount</label>
        <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{$item->discount}}"  >
        @error('number')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="in_stock" class="form-label">In Stock</label>
        <select class="form-select @error('in_stock') is-invalid @enderror" id="in_stock" name="in_stock"  value="{{old('in_stock')}}">
          
          <option value="1" {{$item->in_stock==1 ? 'selected':''}} selected>Yes</option>
          <option value="0" {{$item->in_stock==0 ? 'selected':''}} selected>No</option>
        </select>
        @error('in_stock')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select @error('category_id') is-invalid @enderror" id="category" name="category_id" >
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{$category->id}}" {{$item->category_id == $category->id ? 'selected':''}}>{{$category->name}}</option>
          @endforeach
        </select>
        @error('category_id')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
       <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{$item->description}}" placeholder="Enter Description">
         @error('description')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="text-center">
       <button type="submit" class="btn btn-warning px-4">Update</button>
      </div>
    </form>
  </div>
</div>


@endsection