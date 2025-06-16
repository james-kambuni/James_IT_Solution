<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background-color: #566573;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            padding: 12px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #85c1e9;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background: rgba(59, 130, 246, 0.10);
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center py-3 border-bottom">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('admin.appointments') }}" class="{{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Appointments
        </a>
        <a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
            <i class="fa fa-address-book"></i> Contacts
        </a>
         <a href="{{ route('admin.about.index') }}" class="{{ request()->routeIs('admin.about') ? 'active' : '' }}">
            <i class="fas fa-box"></i> About
        </a>
         <a href="{{ route('admin.about.about-services.index') }}" class="{{ request()->routeIs('admin.about-services') ? 'active' : '' }}">
            <i class="fa fa-info-circle"></i> About Services
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="fa fa-product-hunt"></i> Products
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fa-solid fa-bookmark"></i> Products Categories
        </a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> Orders
        </a>
             <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
            <i class="fa-solid fa-blog"></i> Blogs
        </a>
        </a>
             <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders') ? 'active' : '' }}">
            <i class="fa-solid fa-sliders"></i> Sliders
        </a>
        <a href="{{ route('services.index') }}" class="{{ request()->routeIs('admin.services') ? 'active' : '' }}">
            <i class="fa fa-wrench" aria-hidden="true"></i> Services
        </a>
        <a href="{{ route('admin.users.index') }}" 
   class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
   <i class="fas fa-users"></i> Users
</a>
     <a class="nav-item">
     <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @include('admin.partials.notifications')
        <h2>@yield('title')</h2>
        <hr>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
    // Toggle sidebar on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.createElement('button');
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
        toggleBtn.className = 'btn btn-primary d-md-none position-fixed';
        toggleBtn.style.bottom = '20px';
        toggleBtn.style.right = '20px';
        toggleBtn.style.zIndex = '1000';
        
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
        
        document.body.appendChild(toggleBtn);
    });
</script>
@include('loginmodal')
</body>
</html>