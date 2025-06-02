@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Service</h2>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="mb-3">
            <label class="form-label">Service Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
</div>
        <div class="mb-3">
            <label class="form-label">Service Description</label>
            <textarea name="description" rows="5" class="form-control" required></textarea>
        </div>

        <div class="form-group mb-3">
    <label>Icon Class (e.g. fa fa-cogs or image filename)</label>
    <input type="text" name="icon" class="form-control" placeholder="Enter icon or image filename">
</div>
<div class="form-group">
    <label for="type">Service Type</label>
    <select name="type" id="type" class="form-control">
        <option value="normal">Normal</option>
        <option value="blog">Blog</option>
    </select>
</div>

        <button type="submit" class="btn btn-success">Save Service</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
