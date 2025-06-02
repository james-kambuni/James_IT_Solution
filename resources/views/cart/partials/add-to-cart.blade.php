@props([
    'product' => null,
    'class' => '',
    'showQuantity' => false,
    'quantity' => 1
])

@if($product)
@php
    $isLoggedIn = auth()->check();
@endphp

<button class="btn btn-primary add-to-cart {{ $class }}"
        data-product-id="{{ $product->id }}"
        data-product-name="{{ $product->name }}"
        data-price="{{ $product->price }}"
        data-image="{{ $product->image ? asset($product->image) : asset('images/default-product.jpg') }}"
        @if($showQuantity) data-quantity="{{ $quantity }}" @endif>
    <i class="fas fa-cart-plus"></i> Add to Cart
</button>

@if($showQuantity)
<div class="input-group mt-2" style="max-width: 120px;">
    <button class="btn btn-outline-secondary quantity-minus" type="button">-</button>
    <input type="number" class="form-control text-center quantity-input" 
           value="{{ $quantity }}" min="1" max="10">
    <button class="btn btn-outline-secondary quantity-plus" type="button">+</button>
</div>
@endif

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const isLoggedIn = @json($isLoggedIn); // <- This is passed from PHP to JS

    $('.add-to-cart').click(function (e) {
        e.preventDefault();
        const button = $(this);

        if (!isLoggedIn) {
           toastr.warning("Please log in to add this item to your cart.");
$('#loginModal').modal('show');
            return;
        }

        const data = {
            product_id: button.data('product-id'),
            product_name: button.data('product-name'),
            price: button.data('price'),
            image: button.data('image'),
            quantity: button.data('quantity') || 1,
            _token: '{{ csrf_token() }}'
        };

        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: data,
            success: function (response) {
                if (response.success) {
                    updateCartHeader(response.cart_count, response.total);
                    toastr.success(response.message);
                }
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error adding to cart');
            },
            complete: function () {
                button.prop('disabled', false).html('<i class="fas fa-cart-plus"></i> Add to Cart');
            }
        });
    });

    $('.quantity-plus').click(function () {
        const input = $(this).siblings('.quantity-input');
        input.val(parseInt(input.val()) + 1);
    });

    $('.quantity-minus').click(function () {
        const input = $(this).siblings('.quantity-input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1);
        }
    });
});

function updateCartHeader(count, total) {
    $('.cart-count').text(count);
    $('.cart-total').text('Ksh' + total.toFixed(2));
}
</script>
@endpush
@endif
