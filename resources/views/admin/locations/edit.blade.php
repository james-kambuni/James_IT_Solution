@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Edit Location</h2>
    <form method="POST" action="{{ route('admin.locations.update', $location) }}">
        @csrf @method('PUT')
        <div class="mb-2">
            <label for="region_id">Region</label>
            <select name="region_id" class="form-control" required>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ $location->region_id == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <input type="text" name="name" class="form-control mb-2" value="{{ $location->name }}" required>
        <input type="number" step="0.01" name="shipping_fee" class="form-control mb-2" value="{{ $location->shipping_fee }}" required>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
