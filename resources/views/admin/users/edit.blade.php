@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="card">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        @include('admin.users.form')
    </form>
</div>
@endsection