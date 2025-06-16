@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Category</h2>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Save</button>
    </form>
</div>
@endsection
