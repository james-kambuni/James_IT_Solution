@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Slider</h2>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $slider->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Background Color</label>
            <input type="color" name="background_color" value="{{ old('background_color', $slider->background_color) }}" class="form-control" style="width: 100px;">
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="{{ asset('storage/' . $slider->image) }}" width="200" class="img-thumbnail mb-2">
        </div>

        <div class="mb-3">
            <label class="form-label">Replace Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Slider</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
