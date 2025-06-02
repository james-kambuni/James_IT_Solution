

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->image) }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->description }}</p>
            <h3>${{ number_format($product->price, 2) }}</h3>
            
            @include('cart.partials.add-to-cart', [
                'product' => $product,
                'class' => 'btn-lg' // Customizable button size
            ])
        </div>
    </div>
</div>
@endsection