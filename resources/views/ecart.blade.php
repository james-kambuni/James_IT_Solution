

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>
    
    @if(isset($cartItems) && $cartItems->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product' }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>
                        <input type="number" class="form-control quantity-input" 
                               value="{{ $item->quantity }}" min="1"
                               data-url="{{ route('cart.update', $item->id) }}">
                    </td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    <td>
                        <button class="btn btn-danger remove-item" 
                                data-url="{{ route('cart.remove', $item->id) }}">
                            Remove
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td>${{ number_format($total ?? 0, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="text-right">
            <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
            <button class="btn btn-warning clear-cart" 
                    data-url="{{ route('cart.clear') }}">Clear Cart</button>
        </div>
    @else
        <div class="alert alert-info">Your cart is empty</div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Update quantity
    $('.quantity-input').change(function() {
        const url = $(this).data('url');
        const quantity = $(this).val();
        
        $.ajax({
            url: url,
            method: 'PUT',
            data: { 
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr) {
                alert('Error updating quantity');
            }
        });
    });
    
    // Remove item
    $('.remove-item').click(function() {
        if (confirm('Are you sure you want to remove this item?')) {
            const url = $(this).data('url');
            
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Error removing item');
                }
            });
        }
    });
    
    // Clear cart
    $('.clear-cart').click(function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            const url = $(this).data('url');
            
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Error clearing cart');
                }
            });
        }
    });
});
</script>
@endsection