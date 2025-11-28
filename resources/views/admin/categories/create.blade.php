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

    <form action="{{route('backend.categories.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
         <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter item name" required>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" accept="image/*" class="form-control" id="image" name="image">
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