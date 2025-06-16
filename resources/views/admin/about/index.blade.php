@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit About Us</h2>
    <form method="POST" action="{{ route('admin.about.update') }}">
        @csrf
        <div class="form-group mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $abouts->title ?? '' }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description" rows="5" class="form-control">{{ $abouts->description ?? '' }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Service</label>
            <input type="text" name="service" value="{{ $abouts->service ?? '' }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Icon (FontAwesome or similar class)</label>
            <input type="text" name="icon" value="{{ $abouts->icon ?? '' }}" class="form-control" placeholder="e.g., fa-solid fa-rocket">
        </div>

        <div class="form-group mb-3">
            <label>Service_Description</label>
            <input type="text" name="service" value="{{ $abouts->service_description ?? '' }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
