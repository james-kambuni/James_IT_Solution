@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>About Services</h2>

    <form action="{{ route('admin.about.about-services.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="icon" class="form-control" placeholder="Icon class" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="service" class="form-control" placeholder="Service title" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="description" class="form-control" placeholder="Short description">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100">Add</button>
            </div>
        </div>
    </form>

    @if($services->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Service</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td><i class="{{ $service->icon }}"></i> <small>{{ $service->icon }}</small></td>
                    <td>{{ $service->service }}</td>
                    <td>{{ $service->description }}</td>
                    <td><a href="{{ route('admin.about.about-services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td>
                        <!-- You can replace this with a modal for editing -->
                        <form method="POST" action="{{ route('admin.about.about-services.destroy', $service->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No services added yet.</p>
    @endif
</div>
@endsection
