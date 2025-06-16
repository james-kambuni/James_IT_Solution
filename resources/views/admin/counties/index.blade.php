@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Counties</h2>
    <a href="{{ route('admin.counties.create') }}" class="btn btn-primary mb-2">Add County</a>
    @foreach($counties as $county)
        <div class="d-flex justify-content-between">
            <span>{{ $county->name }}</span>
            <div>
                <a href="{{ route('admin.counties.edit', $county) }}" class="btn btn-sm btn-info">Edit</a>
                <form method="POST" action="{{ route('admin.counties.destroy', $county) }}" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this county?')">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
