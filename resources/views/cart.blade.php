<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- site metas -->
<title>It.Next - IT Service Responsive Html Theme</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<!-- site icons -->
<link rel="icon" href="images/fevicon/fevicon.png" type="image/gif" />
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<!-- Site css -->
<link rel="stylesheet" href="css/style.css" />
<!-- responsive css -->
<link rel="stylesheet" href="css/responsive.css" />
<!-- colors css -->
<link rel="stylesheet" href="css/colors1.css" />
<!-- custom css -->
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/cart.css" />
<!-- wow Animation css -->
<link rel="stylesheet" href="css/animate.css" />
<!-- zoom effect -->
<link rel='stylesheet' href='css/hizoom.css'>
<!-- end zoom effect -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      
</head>
<body id="default_theme" class="it_serv_shopping_cart shopping-cart">
<!-- loader -->
<div class="bg_load"> <img class="loader_animation" src="images/loaders/loader_1.png" alt="#" /> </div>
<!-- end loader -->
<!-- header -->
@include('header')
<!-- end header -->
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Shopping Cart</h1>
              <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">Shopping Cart</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<div class="section padding_layout_1 Shopping_cart_section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="product-table">
          <table class="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th class="text-center">Price</th>
                <th class="text-center">Total</th>
                <th> </th>
              </tr>
            </thead>
           <!-- resources/views/cart.blade.php -->

<tbody id="cart-items-table">
    @forelse($cartItems as $item)
    <tr>
        <td class="col-sm-8 col-md-6">
            <div class="media">
                <a class="thumbnail pull-left" href="#">
                    <img class="media-object mx-auto d-block" style="max-width: 100px;" src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">{{ $item->product->name }}</a></h4>
                    <span>Status: </span>
                <span class="{{ $item->product->status == 1 ? 'text-danger' : 'text-success' }}">
    {{ $item->product->status == 0 ? 'In Stock' : 'Out of Stock' }}
</span>

                </div>
            </div>
        </td>
        <td class="col-sm-1 col-md-1" style="text-align: center">
            <input class="form-control quantity-input" value="{{ $item->quantity }}" type="number" min="1" 
                   data-id="{{ $item->id }}" onchange="updateQuantity(this)">
        </td>
        <td class="col-sm-1 col-md-1 text-center">
            <p class="price_table">KSH{{ number_format($item->price, 2) }}</p>
        </td>
        <td class="col-sm-1 col-md-1 text-center">
            <p class="price_table">KSH{{ number_format($item->price * $item->quantity, 2) }}</p>
        </td>
        <td class="col-sm-1 col-md-1">
    <button type="button" class="bt_main" onclick="removeFromCart({{ $item->id }})">
        <i class="fa fa-trash"></i> Remove
    </button>
</td>

    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Your cart is empty</td>
    </tr>
    @endforelse
</tbody>
          </table>
          <table class="table">
            <tbody>
              <tr class="cart-form">
                <td class="actions"><div class="coupon">
                  </div>
                
                  <input class="button" name="update_cart" value="Update cart" disabled="" type="submit">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="shopping-cart-cart">
          <table>
            <tbody>
              <tr class="head-table">
                <td><h5>Cart Totals</h5></td>
                <td class="text-right"></td>
              </tr>
              <tr>
    <td><h4>Subtotal</h4></td>
    <td class="text-right"><h4 id="cart-subtotal">Ksh{{ number_format($subtotal, 2) }}</h4></td>
</tr>
<tr>
    <td><h5>Estimated shipping</h5></td>
    <td class="text-right"><h4 id="cart-shipping">Ksh{{ number_format($shipping, 2) }}</h4></td>
</tr>
<tr>
    <td><h3>Total</h3></td>
    <td class="text-right"><h4 id="total">Ksh{{ number_format($total, 2) }}</h4></td>
</tr>
              <tr>
                <td><button type="button" class="button" onclick="window.location.href=''">Continue Shopping</button></td>
                <td>
  <a href="{{ route('orders.delivery') }}" class="button">Checkout</a>

</td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="search_bar" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 offset-lg-2 offset-md-2 offset-sm-2 col-xs-10 col-xs-offset-1">
            <div class="navbar-search">
              <form action="#" method="get" id="search-global-form" class="search-global">
                <input type="text" placeholder="Type to search" autocomplete="off" name="s" id="search" value="" class="search-global__input">
                <button class="search-global__btn"><i class="fa fa-search"></i></button>
                <div class="search-global__note">Begin typing your search above and press return to search.</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Model search bar -->
<!-- footer -->
@include('footer')
<!-- end footer -->
<!-- js section -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- menu js -->
<script src="js/menumaker.js"></script>
<!-- wow animation -->
<script src="js/wow.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/cart.js"></script>
<!-- Cart functionality -->


<!-- Cart Icon Button (Trigger) -->
<div id="cart-icon" onclick="toggleCart()">
  🛒 <span id="cart-count">0</span>
</div>

<!-- Cart Modal -->
<!-- Cart Backdrop -->
<div id="cart-backdrop" onclick="closeCartOnOutsideClick(event)">
  <!-- Cart Modal -->
  <div id="shopping-cart" onclick="event.stopPropagation();">
    <div class="cart-header">
      <h5 class="mb-0">🛒 My Cart</h5>
      <button class="close-btn" onclick="toggleCart()"><i class="fa fa-times"></i></button>
    </div>
    <hr>

    <div id="cart-items">
      <div class="cart-item">
        <img src="https://via.placeholder.com/60" alt="Sample">
        <div>
          <div><strong>Sample Product</strong></div>
          <div>Ksh 1000 x 1</div>
        </div>
        <button class="btn btn-outline-danger btn-sm ms-2">Remove</button>
      </div>
    </div>

    <div class="cart-total mt-3">
      <div class="d-flex justify-content-between mb-3">
        <strong>Total:</strong>
        <span>Ksh <span id="cart-total">1000.00</span></span>
      </div>
      <div class="d-flex gap-2">
        <a href="{{ route('cart') }}" class="btn btn-primary btn-sm flex-fill">View Cart</a>
        <a href="{{ route('checkout') }}" class="btn btn-success btn-sm flex-fill">Checkout</a>
      </div>
    </div>
  </div>
</div>


<script>
  // Function to toggle cart visibility
  function toggleCart() {
    const cartElement = document.getElementById('shopping-cart');
    cartElement.style.display = cartElement.style.display === 'block' ? 'none' : 'block';
    if (cartElement.style.display === 'block') {
      fetchCartData();
    }
  }

  // Function to fetch cart data from server
  async function fetchCartData() {
    try {
      const response = await fetch('{{ route("cart.data") }}');
      const data = await response.json();
      
      if (data.success) {
        updateCartDisplay(data.items, data.total, data.item_count);
      }
    } catch (error) {
      console.error('Error fetching cart data:', error);
    }
  }

  // Function to update cart display
  function updateCartDisplay(items, total, itemCount) {
    const cartItemsElement = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartCountElement = document.getElementById('cart-count');
    
    if (!cartItemsElement) return;
    
    // Clear current items
    cartItemsElement.innerHTML = '';
    
    // Add each item to the display
    items.forEach(item => {
      const itemTotal = item.price * item.quantity;
      
      const itemElement = document.createElement('div');
      itemElement.className = 'cart-item';
      itemElement.innerHTML = `
        <img src="/storage/${item.image}" alt="${item.name}" width="50">
        <div>
          <h5>${item.name}</h5>
          <p>Ksh${item.price} x ${item.quantity} = Ksh${itemTotal.toFixed(2)}</p>
          <button class="remove-btn" onclick="removeFromCart(${item.id})"><i class="fa fa-trash-o"style= color:white></i> Remove</button>
        </div>
      `;
      cartItemsElement.appendChild(itemElement);
    });
    
    // Update total and count
    cartTotalElement.textContent = parseFloat(total).toFixed(2);
    cartCountElement.textContent = itemCount;
  }

  // Load initial cart count when page loads
  document.addEventListener('DOMContentLoaded', function() {
    fetchCartData();
  });
</script>
<script>
  function toggleCart() {
    const backdrop = document.getElementById('cart-backdrop');
    backdrop.style.display = (backdrop.style.display === 'flex') ? 'none' : 'flex';
  }

  function closeCartOnOutsideClick(event) {
    // Close cart when clicking outside the cart box
    document.getElementById('cart-backdrop').style.display = 'none';
  }
</script>
</body>
</html>