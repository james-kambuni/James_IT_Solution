@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Blog</h2>
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" width="150" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>
@endsection
