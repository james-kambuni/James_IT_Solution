@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
<div class="card">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="card-header">
            <h3 class="card-title">Create User</h3>
        </div>
        @include('admin.users.form')
    </form>
</div>
@endsection