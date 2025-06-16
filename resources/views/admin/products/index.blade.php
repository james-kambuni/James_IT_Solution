@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Description</th>
                <th>In Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                <td>{{ $product->name }}</td>
                <td>KES {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                 <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"width="60" height="60"></td>
                 <td>{{ $product->description }}</td>
                <td>{{ $product->in_stock ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">No products found.</td></tr>
        @endforelse
        </tbody>
    </table>
<div class="d-flex justify-content-center mt-4">
{{ $products->links() }}
</div>
    
@endsection
