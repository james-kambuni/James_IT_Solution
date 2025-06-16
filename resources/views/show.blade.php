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
<title>James - IT Services</title>
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
<!-- wow Animation css -->
<link rel="stylesheet" href="css/animate.css" />
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
        /* Shopping Cart Styles */
        #shopping-cart {
          position: fixed;
          top: 100px;
          right: 20px;
          width: 350px;
          background: white;
          border: 1px solid #ddd;
          padding: 15px;
          box-shadow: 0 0 10px rgba(0,0,0,0.1);
          z-index: 1000;
          display: none;
        }
        
        .cart-item {
          display: flex;
          margin-bottom: 10px;
          padding-bottom: 10px;
          border-bottom: 1px solid #eee;
        }
        
        .cart-item img {
          margin-right: 10px;
        }
        
        .cart-header {
          display: flex;
          justify-content: space-between;
          margin-bottom: 15px;
        }
        
        .cart-total {
          font-weight: bold;
          margin-top: 10px;
          text-align: right;
        }
        
        #cart-icon {
          position: fixed;
          top: 150px;
          right: 20px;
          background: #333;
          color: white;
          padding: 10px 15px;
          border-radius: 50%;
          cursor: pointer;
          z-index: 999;
        }
        
        #cart-count {
          background: red;
          color: white;
          border-radius: 50%;
          padding: 2px 6px;
          font-size: 12px;
          margin-left: 5px;
        }
      </style>
</head>
<body id="default_theme" class="it_shop_list">
<!-- loader -->
<div class="bg_load"> <img class="loader_animation" src="images/loaders/loader_1.png" alt="#" /> </div>
<!-- end loader -->
<!-- header -->
<header id="default_header" class="header_style_1">
  <!-- header top -->
  <div class="header_top">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="full">
            <div class="topbar-left">
              <ul class="list-inline">
                <li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span class="topbar-hightlight">540 Lorem Ipsum New York, AB 90218</span> </li>
                <li> <span class="topbar-label"><i class="fa fa-envelope-o"></i></span> <span class="topbar-hightlight"><a href="mailto:info@yourdomain.com">info@yourdomain.com</a></span> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4 right_section_header_top">
          <div class="float-left">
            <div class="social_icon">
              <ul class="list-inline">
                <li><a class="fa fa-facebook" href="https://www.facebook.com/" title="Facebook" target="_blank"></a></li>
                <li><a class="fa fa-google-plus" href="https://plus.google.com/" title="Google+" target="_blank"></a></li>
                <li><a class="fa fa-twitter" href="https://twitter.com" title="Twitter" target="_blank"></a></li>
                <li><a class="fa fa-linkedin" href="https://www.linkedin.com" title="LinkedIn" target="_blank"></a></li>
                <li><a class="fa fa-instagram" href="https://www.instagram.com" title="Instagram" target="_blank"></a></li>
              </ul>
            </div>
          </div>
          <div class="float-right">
            <div class="make_appo"> <a class="btn white_btn" href="make_appointment.html">Make Appointment</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end header top -->
  <!-- header bottom -->
  @include('header')
  <!-- header bottom end -->
</header>
<body>

  <div class="container my-5">
    <div class="row">
      <!-- Product Image -->
      <div class="col-md-5">
        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
      </div>

      <!-- Product Details -->
      <div class="col-md-7">
  <h2>{{ $product->name }}</h2>
  
  <table class="table table-bordered mt-3">
    <tbody>
      <tr>
        <th scope="row" style="width: 30%;">Price</th>
        <td>Ksh {{ number_format($product->price, 2) }}</td>
      </tr>
      <tr>
        <th>Status</th>
        <td>
          @if($product->in_stock)
            <span class="badge bg-success" style="color: white;">In Stock</span>
          @else
            <span class="badge bg-danger" style="color: white;">Out of Stock</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>Description</th>
        <td>{{ $product->description }}</td>
      </tr>
    </tbody>
  </table>

  <div class="mt-3">
    @include('cart.partials.add-to-cart', ['product' => $product])
  </div>
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
            <div class="product_img text-center">
            <img class="img-fluid" src="{{ asset('storage/' . $rel->image) }}" class="card-img-top" alt="{{ $rel->name }}">
            <div class="card-body text-center d-flex flex-column">
              <h5 class="card-title">{{ $rel->name }}</h6>
              <p class="card-text">Ksh {{ number_format($rel->price, 2) }}</p>
              <a href="{{ route('show', $rel->id) }}" class="btn btn-sm btn-outline-primary mt-auto">View</a>
            </div>
          </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
  <!-- Bootstrap JS (via CDN) -->
 @include('footer')
<!-- end footer -->
<!-- js section -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- menu js -->
<script src="js/menumaker.js"></script>
<!-- wow animation -->
<script src="js/wow.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/cart.js"></script>
<script src="revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
<!-- end google map js -->
<div id="cart-icon" onclick="toggleCart()">
  🛒 <span id="cart-count">0</span>
</div>
@include('ecart')
<!-- Shopping Cart -->
<div id="shopping-cart">
  <div class="cart-header">
    <h3>Your Cart</h3>
    <button onclick="toggleCart()">Close</button>
  </div>
  <div id="cart-items"></div>
  <div class="cart-total">
    Total: Ksh<span id="cart-total">0.00</span>
    <div style="margin-top: 10px;">
      <a href="{{ route('cart') }}" class="btn btn-primary">View Cart</a>
      <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
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
          <button onclick="removeFromCart(${item.id})">Remove</button>
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


</body>
</html>

