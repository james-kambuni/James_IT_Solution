@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Add Location</h2>
    <form method="POST" action="{{ route('admin.locations.store') }}">
        @csrf
        <div class="mb-2">
            <label for="region_id">Region</label>
            <select name="region_id" class="form-control" required>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="text" name="name" class="form-control mb-2" placeholder="Location Name" required>
        <input type="number" step="0.01" name="shipping_fee" class="form-control mb-2" placeholder="Shipping Fee (Ksh)" required>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
