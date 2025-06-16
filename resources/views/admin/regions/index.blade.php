@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Regions</h2>

    <a href="{{ route('admin.regions.create') }}" class="btn btn-primary mb-3">Add Region</a>

    @if($regions->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Region Name</th>
                    <th>County</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regions as $region)
                    <tr>
                        <td>{{ $region->name }}</td>
                        <td>{{ $region->county->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-sm btn-info">Edit</a>

                            <form method="POST" action="{{ route('admin.regions.destroy', $region) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this region?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No regions found.</p>
    @endif
</div>
@endsection
