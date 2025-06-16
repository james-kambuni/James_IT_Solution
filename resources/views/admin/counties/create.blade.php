@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Add County</h2>
    <form method="POST" action="{{ route('admin.counties.store') }}">
        @csrf
        <input type="text" name="name" class="form-control mb-2" placeholder="County Name" required>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
