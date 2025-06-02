@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">All Services</h2>

    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Add New Service</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Icon</th>
                <th>Title</th>
                <th>Type</th>
                <th>Image</th>
                <th>Description</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $service->icon !!}</td>
                    <td>{{ $service->title }}</td>
                    <td>{{ ucfirst($service->type) }}</td>
                    <td>{{ $service->image }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($service->description, 80) }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-info">Edit</a>

                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No services found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
