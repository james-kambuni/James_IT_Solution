@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add Region</h2>

    <form method="POST" action="{{ route('admin.regions.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Region Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Region Name" required>
        </div>

        <div class="mb-3">
            <label for="county_id" class="form-label">Select County</label>
            <select name="county_id" id="county_id" class="form-select" required>
                <option value="">-- Select County --</option>
                @foreach($counties as $county)
                    <option value="{{ $county->id }}">{{ $county->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
