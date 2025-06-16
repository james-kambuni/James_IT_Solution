@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Slider Management</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary mt-3 mb-3">Add New Slider</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Background Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sliders as $slider)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $slider->image) }}" width="120" class="img-thumbnail">
                    </td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->subtitle }}</td>
                    <td>
                        <div style="width: 30px; height: 30px; background: {{ $slider->background_color }}"></div>
                    </td>
                    <td>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slider?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No sliders found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
