@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Locations</h2>
    <a href="{{ route('admin.locations.create') }}" class="btn btn-primary mb-2">Add Location</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Region</th>
                <th>Shipping Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($locations as $location)
            <tr>
                <td>{{ $location->name }}</td>
                <td>{{ $location->region->name }}</td>
                <td>Ksh {{ number_format($location->shipping_fee, 2) }}</td>
                <td>
                    <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-sm btn-info">Edit</a>
                    <form method="POST" action="{{ route('admin.locations.destroy', $location) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this location?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
