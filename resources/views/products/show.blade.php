@extends('shop')

@section('title', $product->name)

@section('content')
<div class="container my-5">
  <div class="row">
    <!-- Product Image -->
    <div class="col-md-5">
      <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
    </div>

    <!-- Product Details -->
    <div class="col-md-7">
      <h2>{{ $product->name }}</h2>
      <p class="text-muted">Price: Ksh {{ number_format($product->price, 2) }}</p>
      <p>Status:
        @if($product->in_stock)
          <span class="badge bg-success">In Stock</span>
        @else
          <span class="badge bg-danger">Out of Stock</span>
        @endif
      </p>
      <p>{{ $product->description }}</p>
      @include('cart.partials.add-to-cart', ['product' => $product])
    </div>
  </div>

  <!-- Related Products -->
  @if($related->count())
  <div class="mt-5">
    <h4>Related Products</h4>
    <div class="row">
      @foreach($related as $rel)
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card h-100">
          <img src="{{ asset('storage/' . $rel->image) }}" class="card-img-top" alt="{{ $rel->name }}">
          <div class="card-body text-center d-flex flex-column">
            <h6>{{ $rel->name }}</h6>
            <p>Ksh {{ number_format($rel->price, 2) }}</p>
            <a href="{{ route('products.show', $rel->id) }}" class="btn btn-sm btn-outline-primary mt-auto">View</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</div>
@endsection
