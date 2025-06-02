@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Service</h2>

    <form action="{{ route('admin.services.update', $service->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Service Title</label>
            <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
        </div>
<div class="form-group mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    @if($service->image)
        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" width="100" class="mt-2">
    @endif
</div>

        <div class="mb-3">
            <label class="form-label">Service Description</label>
            <textarea name="description" rows="5" class="form-control" required>{{ $service->description }}</textarea>
        </div>

        <div class="form-group mb-3">
    <label>Icon Class</label>
    <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
</div>
<div class="form-group">
    <label for="type">Service Type</label>
    <select name="type" id="type" class="form-control">
        <option value="normal" {{ old('type', $service->type ?? '') == 'normal' ? 'selected' : '' }}>Normal</option>
        <option value="blog" {{ old('type', $service->type ?? '') == 'blog' ? 'selected' : '' }}>Blog</option>
    </select>
</div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
