$(document).ready(function() {
    // Initialize cart on page load
    fetchCart();
    
    // Add to cart handler (delegated for dynamic elements)
    $(document).on('click', '.add-to-cart', function(e) {
      e.preventDefault();
      addToCart($(this));
    });
    
    // Remove item handler (delegated)
    $(document).on('click', '.remove-item', function() {
      removeFromCart($(this).data('item-id'));
    });
  });
  
  // Fetch cart data from server
  function fetchCart() {
    $.get('/cart/data')
      .done(updateCartUI)
      .fail(function() {
        console.error('Failed to load cart data');
      });
  }
  
  // Add item to cart
  function addToCart(button) {
    const productId = button.data('product-id');
    const productName = button.data('product-name');
    const price = button.data('price');
    const image = button.data('image');
    
    // Show loading state
    const originalHtml = button.html();
    button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
    
    $.ajax({
      url: '/cart/add',
      method: 'POST',
      data: {
        product_id: productId,
        product_name: productName,
        price: price,
        image: image,
        quantity: 1,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          updateCartUI(response);
          showToast(productName + ' added to cart!', 'success');
        }
      },
      error: function(xhr) {
        console.error('Error:', xhr.responseJSON);
        showToast(xhr.responseJSON?.message || 'Error adding to cart', 'error');
      },
      complete: function() {
        button.prop('disabled', false).html(originalHtml);
      }
    });
  }
  
  // Update cart UI
  function updateCartUI(cartData) {
    if (!cartData) return;
    
    // Update cart count
    $('.cart-count').text(cartData.item_count || 0);
    
    // Update cart dropdown
    const $cartDropdown = $('#cart-dropdown');
    $cartDropdown.empty();
    
    if (!cartData.items || cartData.items.length === 0) {
      $cartDropdown.append('<div class="dropdown-item">Your cart is empty</div>');
      return;
    }
    
    cartData.items.forEach(item => {
      $cartDropdown.append(`
        <div class="dropdown-item cart-item">
          <img src="${item.image || '/images/default-product.jpg'}" width="30" alt="${item.name}">
          <span>${item.name} (${item.quantity})</span>
          <span>$${(item.price * item.quantity).toFixed(2)}</span>
          <button class="btn btn-sm btn-danger remove-item" 
                  data-item-id="${item.id}">×</button>
        </div>
      `);
    });
    
    $cartDropdown.append(`
      <div class="dropdown-divider"></div>
      <div class="dropdown-item">
        <strong>Total: Ksh${cartData.total?.toFixed(2) || '0.00'}</strong>
      </div>
      <div class="dropdown-item">
        <a href="/cart" class="btn btn-primary btn-sm">View Cart</a>
        <a href="/checkout" class="btn btn-success btn-sm">Checkout</a>
      </div>
    `);
  }
  
  // Remove item from cart
  function removeFromCart(itemId) {
    if (!confirm('Remove this item from cart?')) return;
    
    $.ajax({
      url: '/cart/remove/' + itemId,
      method: 'DELETE',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          updateCartUI(response);
          showToast('Item removed from cart', 'success');
        }
      },
      error: function(xhr) {
        showToast('Failed to remove item', 'error');
      }
    });
  }
  
  // Helper function for notifications
  function showToast(message, type = 'success') {
    // Replace with your preferred notification system
    if (type === 'success') {
      alert(message); // Replace with toastr.success(message) if available
    } else {
      alert(message); // Replace with toastr.error(message) if available
    }
  }

  