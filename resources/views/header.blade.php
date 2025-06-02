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
                <li> <a class="#" href="{{ url('/') }}">Home</a>
                </li>
                <li><a href="{{ url('/aboutus') }}">About Us</a></li>
                <li> <a href="{{ url('/service') }}">Service</a>
                </li>
                <li> <a href="{{ url('/blog') }}">Blog</a>
                </li>
                <li> <a href="#"> More</a>
                  <ul>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="{{ url('/error') }}">Error 404</a></li>
                  </ul>
                </li>
                <li> <a href="{{ url('/shop') }}">Shop</a>
                  <ul>
                    <li><a href="{{ url('/shop') }}">Visit our Shop</a></li>
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
            <li><a href="{{ route('user.orders') }}">My Orders</a></li>
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