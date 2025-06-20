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
<!-- revolution slider css -->
<link rel="stylesheet" type="text/css" href="revolution/css/settings.css" />
<link rel="stylesheet" type="text/css" href="revolution/css/layers.css" />
<link rel="stylesheet" type="text/css" href="revolution/css/navigation.css" />
<!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<body id="default_theme" class="it_service">
<!-- loader -->
<!-- <div class="bg_load"> <img class="loader_animation" src="images/loaders/loader_1.png" alt="#" /> </div> -->
<div class="preloader-single">
                            <div class="ts_preloading_box">
                                <div id="ts-preloader-absolute17">
                                    <div class="tsperloader17" id="tsperloader17_one"></div>
                                    <div class="tsperloader17" id="tsperloader17_two"></div>
                                    <div class="tsperloader17" id="tsperloader17_three"></div>
                                    <div class="tsperloader17" id="tsperloader17_four"></div>
                                </div>
                            </div>
                        </div>
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
                <li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span class="topbar-hightlight">Zimmermann, Nairobi</span> </li>
                <li> <span class="topbar-label"><i class="fa fa-envelope-o"></i></span> <span class="topbar-hightlight"><a href="vkambuni@gmail.com">vkambuni@gmail.com</a></span> </li>
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
            <div class="make_appo"> <a class="btn white_btn" href="{{ url('/appointment') }}">Make Appointment</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end header top -->
  <!-- header bottom -->
  <div class="header_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
          <!-- logo start -->
          <div class="logo"> <a href="{{ url('/index') }}"><img src="" alt="logo" /></a> </div>
          <!-- logo end -->
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
          <!-- menu start -->
          <div class="menu_side">
            <div id="navbar_menu">
              <ul class="first-ul">
                <li> <a class="active" href="{{ url('/index') }}">Home</a>
                </li>
                <li><a href="{{ url('/aboutus') }}">About Us</a></li>
                <li> <a href="{{ url('/service') }}">Service</a>
                </li>
                <li> <a href="{{ url('/blog') }}">Blog</a>
                </li>
                <li> <a href="#">Pages</a>
                  <ul>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="{{ url('/error') }}">Error 404</a></li>
                  </ul>
                </li>
                <li> <a href="{{ url('/shop') }}">Shop</a>
                  <ul>
                  <li><a href="{{ url('/products.index') }}">Products</a></li>
                    <li><a href="{{ url('/shop') }}">Shop List</a></li>
                    <li><a href="it_shop_detail.html">Shop Detail</a></li>
                    <li><a href="{{ url('/cart') }}">Shopping Cart</a></li>
                    <li><a href="{{ url('/checkout') }}">Checkout</a></li>
                  </ul>
                </li>
                <li> <a href="{{ url('/contact') }}">Contact</a>
                </li>
                <li class="dropdown">
           @auth
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ auth()->user()->name }} <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('user.dashboard') }}">My Orders</a></li>

      @if(session()->has('impersonated_by')) {{-- Laravel Impersonate package uses this session --}}
            <li>
                <a href="{{ route('admin.users.leave-impersonate') }}">
                    🔙 Leave Impersonate
                </a>
            </li>
        @endif

        <li>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background:none;border:none;padding-left: 15px;color: #333;">Logout</button>
            </form>
        </li>
    </ul>
           @else
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account <span class="caret"></span>
           </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        </ul>
    @endauth
</li>
              </ul>
            </div>
            <div class="search_icon">
              <ul>
                <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
          <!-- menu end -->
        </div>
      </div>
    </div>
  </div>
  <!-- header bottom end -->
</header>
@stack('scripts')
<!-- end header -->
<!-- section -->
<div id="slider" class="section main_slider">
  <div class="container-fuild">
    <div class="row">
      <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
        <!-- START REVOLUTION SLIDER 5.0.7 auto mode -->
        <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
          <ul>
             @foreach ($sliders as $slider)
            <li  data-index="rs-1812" data-transition="zoomin" data-slotamount="7"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="{{ asset('storage/'.$slider->image) }}"  data-rotate="0"  data-saveperformance="off"  data-title="Computer Services" data-description="">
              <!-- MAIN IMAGE -->
              <img src="{{ asset('storage/'.$slider->image) }}"  alt="#"  data-bgposition="center center" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
              <!-- LAYERS -->
              <!-- LAYER NR. BG -->
              <div class="tp-caption tp-shape tp-shapewrapper   rs-parallaxlevel-0" 
                              id="slide-270-layer-1012" 
                              data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                              data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                              data-width="full"
                              data-height="full"
                              data-whitespace="nowrap"
                              data-transform_idle="o:1;"
                              data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                              data-transform_out="s:300;s:300;" 
                              data-start="750" 
                              data-basealign="slide" 
                              data-responsive_offset="on" 
                              data-responsive="off"
                              style="z-index: 5;background-color:rgba(0, 0, 0, 0.25);border-color:rgba(0, 0, 0, 0.50);"> </div>
              <!-- LAYER NR. 1 -->
              <div class="tp-caption tp-shape tp-shapewrapper   tp-resizeme rs-parallaxlevel-0" 
                              id="slide-18-layer-912" 
                              data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                              data-y="['middle','middle','middle','middle']" data-voffset="['15','15','15','15']" 
                              data-width="500"
                              data-height="140"
                              data-whitespace="nowrap"
                              data-transform_idle="o:1;"
                              data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;" 
                              data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                              data-mask_in="x:0px;y:0px;" 
                              data-mask_out="x:inherit;y:inherit;" 
                              data-start="2000" 
                              data-responsive_offset="on" 
                              style="z-index: 5;background-color:rgba(29, 29, 29, 0.85);border-color:rgba(0, 0, 0, 0.50);"> </div>
              <!-- LAYER NR. 2 -->
              <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0" 
                              id="slide-18-layer-112" 
                              data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                              data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                              data-fontsize="['70','70','70','35']"
                              data-lineheight="['70','70','70','50']"
                              data-width="none"
                              data-height="none"
                              data-whitespace="nowrap"
                              data-transform_idle="o:1;"
                              data-transform_in="y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" 
                              data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                              data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                              data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                              data-start="1000" 
                              data-splitin="chars" 
                              data-splitout="none" 
                              data-responsive_offset="on" 
                              data-elementdelay="0.05" 
                              style="z-index: 6; white-space: nowrap;">{{ $slider->title }}</div>
              <!-- LAYER NR. 3 -->
              <div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-0" 
                              id="slide-18-layer-412" 
                              data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                              data-y="['middle','middle','middle','middle']" data-voffset="['52','51','51','31']" 
                              data-width="none"
                              data-height="none"
                              data-whitespace="nowrap"
                              data-transform_idle="o:1;"
                              data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                              data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                              data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                              data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                              data-start="1500" 
                              data-splitin="none" 
                              data-splitout="none" 
                              data-responsive_offset="on" 
                              style="z-index: 7; white-space: nowrap;">{{ $slider->subtitle }} </div>
            </li>
            @endforeach
          </ul>
          <div class="tp-static-layers"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->
<!-- section -->
<div class="section padding_layout_1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_center">
            <h2>Why Choose Us</h2>
            <p class="large">Fastest repair service with best price!</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
     @foreach($aboutServices as $service)
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="full">
                    <div class="service_blog_inner2">
                        <div class="icon">
                            <i class="fa {{ $service->icon }}"></i>
                        </div>
                        <h4 class="service-heading">{{ $service->service }}</h4>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
    </div>

    <div class="row" style="margin-top: 35px">
      <div class="col-md-8">
  <div class="full margin_bottom_30">
    <div class="accordion border_circle">
      <div class="bs-example">
        <div class="panel-group" id="accordion">
          @foreach($normalServices as $index => $service)
            <div class="panel panel-default">
              <div class="panel-heading">
                <p class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $index }}">
                    <i class="{{ $service->icon }}" aria-hidden="true"></i> {{ $service->title }}
                    <i class="fa fa-angle-down"></i>
                  </a>
                </p>
              </div>
              <div id="collapse{{ $index }}" class="panel-collapse collapse {{ $index === 0 ? 'in' : '' }}">
                <div class="panel-body">
                  <p>{{ $service->description }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

      <div class="col-md-4">
        <div class="full" style="margin-top: 35px;">
          <h3>Need file recovery?</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et 
            quasi architecto beatae vitae dicta sunt explicabo.. </p>
          <p><a class="btn main_bt" href="#">Read More</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->
<!-- section -->

<!-- section -->
<div class="section padding_layout_1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_center">
            <h2>Our Products</h2>
            <p class="large">We package the products with best services to make you a happy customer.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Only one row here -->
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
            <!-- Stock status -->
              <a @if($product->in_stock === 1)
              <span class="badge bg-success" style="color: white;">In Stock</span>
              @else
             <span class="badge bg-danger" style="color: white;">Out of Stock</span>
              @endif</a></br>
              @include('cart.partials.add-to-cart', ['product' => $product])
            </div>
          </div>
          </a>
        </div>
      @endforeach
    </div>
    
  </div>
</div>

               <!-- @auth
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf                
    </form>
@else
    <p><a href="{{ route('login') }}">Log in</a> to add items to cart.</p>
@endauth -->
<!-- end section -->
<!-- section -->
<div class="section padding_layout_1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_left">
            <h2>Latest from Our Blog</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($blogs as $blog)
        <div class="col-md-4">
          <div class="full blog_colum">
            <div class="blog_feature_img">
              <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid" />
            </div>
            <div class="post_time">
              <p><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('F d, Y') }} ( By {{ $blog->author }})</p>
            </div>
            <div class="blog_feature_head">
              <h4>{{ $blog->title }}</h4>
            </div>
            <div class="blog_feature_cont">
              <p>{{ Str::limit(strip_tags($blog->content), 100) }}</p>
              <a class="btn btn-sm btn-primary mt-2" href="{{ route('blog.show', $blog->slug) }}">
                Read More <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- end section -->
<!-- section -->
<div class="section padding_layout_1 testmonial_section white_fonts">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_left">
            <h2 style="text-transform: none;">Some of our services?</h2>
            <p class="large">We offers the following services among many more others...</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-7">
        <div class="full">
          <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#testimonial_slider" data-slide-to="0" class="active"></li>
              <li data-target="#testimonial_slider" data-slide-to="1"></li>
              <li data-target="#testimonial_slider" data-slide-to="2"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
  @foreach($blogServices as $index => $service)
    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
      <div class="testimonial-container">
        <div class="testimonial-meta">
          <h4>{{ $service->title }}</h4>
          <span class="testimonial-position">{{ $service->subtitle ?? 'Blog Service' }}</span>
        </div>
        
        <div class="testimonial-photo">
          <img src="{{ asset('storage/' . $service->image) }}" class="img-responsive" alt="{{ $service->title }}" width="150" height="150">
        </div>
        <div class="testimonial-content">
          {{ Str::limit($service->description, 200) }}
        </div>
      </div>
    </div>
  @endforeach
</div>

          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="full"> </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->
<!-- section -->
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="contact_us_section">
            <div class="call_icon"> <img src="images/it_service/phone_icon.png" alt="#" /> </div>
            <div class="inner_cont">
              <h2>Contact us today!</h2>
              <p>We are ready to serve you</p>
            </div>
            <div class="button_Section_cont"> <a class="btn dark_gray_bt" href="{{ url('/contact') }}">Contact us</a> </div>
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
 @include('loginmodal')
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
<!-- revolution js files -->
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

<script>
  window.addEventListener('load', () => {
    document.querySelector('.preloader-single').style.display = 'none';
  });
</script>

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
        <a href="{{ route('cart') }}" class="btn btn-outline-primary btn-sm flex-fill">View Cart</a>
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


<script>
    jQuery(document).ready(function () {
        jQuery("#rev_slider_4_1").show().revolution({
            sliderType: "standard",
            sliderLayout: "fullscreen",
            delay: 9000,
            navigation: {
                arrows: { enable: true }
            },
            parallax: {
                type: "scroll",
                origo: "slidercenter",
                speed: 1000,
                levels: [5,10,15,20,25,30,35,40,45,50]
            },
            gridwidth: 1170,
            gridheight: 600
        });
    });
</script>

<script>/** dark mode js* */	
function toggleDarkMode() {
  const html = document.documentElement;
  html.classList.toggle('dark');
  if (html.classList.contains('dark')) {
    localStorage.setItem('theme', 'dark');
  } else {
    localStorage.setItem('theme', 'light');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.documentElement.classList.add('dark');
  }
});
	</script>
  
</body>
</html>
