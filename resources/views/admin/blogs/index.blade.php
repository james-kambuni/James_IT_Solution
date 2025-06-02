@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>All Blog Posts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.blogs.create') }}" class="btn btn-success mb-3">+ Add New Blog</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->author }}</td>
                    <td>{{ $blog->created_at->format('d M Y') }}</td>
                    <td>
                       <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-info btn-sm">View</a>
                     <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;" 
                     onsubmit="return confirm('Are you sure?');">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $blogs->links() }}
</div>
@endsection
