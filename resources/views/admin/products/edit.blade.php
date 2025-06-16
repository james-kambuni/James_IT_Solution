@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products.form', ['product' => $product])
    </form>

@endsection
