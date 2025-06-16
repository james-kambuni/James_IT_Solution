@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Service</h2>
    <form action="{{ route('admin.about.about-services.update', $aboutService->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Icon (FontAwesome class)</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $aboutService->icon) }}">
        </div>

        <div class="form-group">
            <label>Service Title</label>
            <input type="text" name="service" class="form-control" value="{{ old('service', $aboutService->service) }}">
        </div>

        <div class="form-group">
            <label>Service Description</label>
            <textarea name="service_description" class="form-control" rows="4">{{ old('service_description', $aboutService->service_description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
