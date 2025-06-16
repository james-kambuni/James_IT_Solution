@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Slider</h2>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title (optional)</label>
            <input type="text" name="title" class="form-control" placeholder="Slider title">
        </div>

        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtitle (optional)</label>
            <input type="text" name="subtitle" class="form-control" placeholder="Slider subtitle">
        </div>

        <div class="mb-3">
            <label for="background_color" class="form-label">Background Color (optional)</label>
            <input type="color" name="background_color" class="form-control" style="width: 100px;">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Slider Image <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Slider</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
