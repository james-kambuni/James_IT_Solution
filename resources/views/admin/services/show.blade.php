<!DOCTYPE html>
<html lang="en">
<head>
    <!-- All meta and CSS links as provided -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $service->title }} - James IT Services</title>

    <!-- CSS -->
    <link rel="icon" href="{{ asset('images/fevicon/fevicon.png') }}" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
</head>
<body id="default_theme" class="it_service blog">

<!-- Loader -->
<div class="bg_load">
    <img class="loader_animation" src="{{ asset('images/loaders/loader_1.png') }}" alt="#" />
</div>

<!-- Header -->
<header id="default_header" class="header_style_1">
    <!-- Topbar -->
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline">
                        <li><i class="fa fa-home"></i> 540 Lorem Ipsum New York, AB 90218</li>
                        <li><i class="fa fa-envelope-o"></i> <a href="mailto:info@yourdomain.com">info@yourdomain.com</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <div class="social_icon">
                        <ul class="list-inline mb-0">
                            <li><a class="fa fa-facebook" href="#"></a></li>
                            <li><a class="fa fa-google-plus" href="#"></a></li>
                            <li><a class="fa fa-twitter" href="#"></a></li>
                            <li><a class="fa fa-linkedin" href="#"></a></li>
                            <li><a class="fa fa-instagram" href="#"></a></li>
                        </ul>
                    </div>
                    <a class="btn white_btn" href="#">Make Appointment</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your nav -->
    @include('header')
</header>

<!-- Banner -->
<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">{{ $service->title }}</h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Service Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Service Content -->
<section class="layout_padding py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $service->title }}</h2>
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid my-3">
                @endif
                <p>{{ $service->description }}</p>
                <p><strong>Type:</strong> {{ ucfirst($service->type) }}</p>
                <p><strong>Is Blog:</strong> {{ $service->is_service_blog ? 'Yes' : 'No' }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('footer')

<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/menumaker.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap" async defer></script>

</body>
</html>
