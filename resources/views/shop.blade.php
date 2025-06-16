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
<link rel="stylesheet" href="css/cart.css" />
<!-- wow Animation css -->
<link rel="stylesheet" href="css/animate.css" />
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

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
<!-- end header -->
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Shop Page</h1>
              <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">Shop</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<!-- section -->
<div class="section padding_layout_1 product_list_main">
  <div class="container">
    <div class="full">
          <div class="main_heading text_align_center">
            <h2>Our Products</h2>
            <p class="large">We package the products with best services to make you a happy customer.</p>
          </div>
        </div>
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          @foreach($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
  <a href="{{ route('show', $product->id) }}" class="text-decoration-none text-dark">
  <div class="card h-100">
    <div class="product_img text-center">
      <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    </div>
    <div class="card-body text-center">
      <h5 class="card-title">{{ $product->name }}</h5>
      <p class="card-text">Amount Ksh {{ number_format($product->price, 2) }}</p>
      @if($product->in_stock)
        <span class="badge bg-success" style="color: black;">In Stock</span>
      @else
        <span class="badge bg-danger" style="color: black;">Out of Stock</span>
      @endif
        @include('cart.partials.add-to-cart', ['product' => $product])
    </div>
  </div>
</a>

</div>
      @endforeach
        </div>
     <div class="mt-4 pagination-wrapper">
    {{ $products->links() }}
</div>

    
      </div>
      @stack('scripts')

      <!-- Sidebar column (now comes second in HTML but will appear on right) -->
      <div class="col-md-3">
        <div class="side_bar">
          <!-- Search section -->
          <div class="side_bar_blog">
            <h4>SEARCH</h4>
            <div class="side_bar_search">
              <div class="input-group stylish-input-group">
                <input class="form-control" placeholder="Search" type="text">
                <span class="input-group-addon">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span> 
              </div>
            </div>
          </div>
          
          <!-- Services section -->
     <div class="side_bar_blog">
    <h4>OUR SERVICES</h4>
    <div class="categary">
        <ul>
            @foreach($serviceBlogs as $service)
                <li>
                    <a href="{{ route('service.show', $service->id) }}">
                        <i class="fa fa-angle-right"></i> {{ $service->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


        </div>
      </div>
    </div>
  </div>
</div>

<!-- end section -->

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

<!-- Cart Icon Button (Trigger) -->
<div id="cart-icon" onclick="toggleCart()">
  🛒 <span id="cart-count" class="cart-count">0</span>
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
        <a href="{{ url('delivery') }}" class="btn btn-success btn-sm flex-fill">Checkout</a>
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
          <button class="remove-btn" onclick="removeFromCart(${item.id})">
              <i class="fa fa-trash-o" style="color:white;"></i> Remove
          </button>

        </div>
      `;
      cartItemsElement.appendChild(itemElement);
    });
    
    // Update total and count
    cartTotalElement.textContent = parseFloat(total).toFixed(2);
    document.querySelectorAll('.cart-count, #cart-count').forEach(el => {
    el.textContent = itemCount;
});

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
