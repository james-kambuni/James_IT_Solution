@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Create New Blog Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter blog title" required>
        </div>
        <div class="row mb-3">
        <div class="col-md-6">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" placeholder="Auto-generated or editable">
        </div>
        <div class="col-md-6">
        <label>Author</label>
        <input type="text" name="author" class="form-control" value="{{ auth()->user()->name ?? '' }}" readonly>
         </div>
        </div>
        <div class="form-group mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="6" placeholder="Enter blog content" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Publish</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
<script>
    document.getElementById('title').addEventListener('input', function () {
        const title = this.value;
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')   // Remove invalid chars
            .replace(/\s+/g, '-')           // Replace whitespace with -
            .replace(/-+/g, '-');           // Collapse dashes

        document.getElementById('slug').value = slug;
    });
</script>
