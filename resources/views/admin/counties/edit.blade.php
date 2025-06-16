@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Edit County</h2>
    <form method="POST" action="{{ route('admin.counties.update', $county) }}">
        @csrf @method('PUT')
        <input type="text" name="name" class="form-control mb-2" value="{{ $county->name }}" required>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
