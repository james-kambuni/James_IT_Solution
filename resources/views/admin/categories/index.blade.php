@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>All Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
