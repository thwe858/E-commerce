@extends('layouts.admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg p-4">
    <h3 class="text-center mb-4">Create Item</h3>

    <form action="{{route('backend.items.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="mb-3">
        <label for="code_no" class="form-label">Code No</label>
        <input type="text" class="form-control @error('code_no') is-invalid @enderror" id="code_no" name="code_no" placeholder="Enter item code" value="{{old('code_no')}}" >
        @error('code_no')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Item Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Enter item name" >
        @error('name')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
        @error('image')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}" placeholder="Enter price" >
        @error('price')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="discount" class="form-label">Discount</label>
        <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{old('discount')}}" placeholder="Enter price" >
        @error('number')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="in_stock" class="form-label">In Stock</label>
        <select class="form-select @error('in_stock') is-invalid @enderror" id="in_stock" name="in_stock"  value="{{old('in_stock')}}">
          
          <option value="1" selected>Yes</option>
          <option value="0">No</option>
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
            <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected':''}}>{{$category->name}}</option>
          @endforeach
        </select>
        @error('category_id')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
       <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{old('description')}}" placeholder="Enter Description">
         @error('description')
          <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary px-4">Create</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>

@endsection