
@extends('index')
@section('content')
<div class="container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                <div class="product_list">
                    <div class="product_detail_btm">
                <div class="card">
                <div class="product_img"> <img class="img-responsive" src="{{ asset($product->image) }}" class="card-img-top" alt=""> </div>
                   <!-- <img src="{{ asset($product->image) }}" class="card-img-top"> -->
                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>
                        <p>${{ number_format($product->price, 2) }}</p>
                        
                        <!-- Include reusable add-to-cart button -->
                       @include('cart.partials.add-to-cart', ['product' => $product])
                    </div>
                </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection