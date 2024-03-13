<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Books and Tutorials Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Use Minified Plugins Version For Fast Page Load --}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{ url('/frontend/css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ url('/frontend/css/main.css') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/frontend/image/favicon.ico') }}">
    <script src="{{ url('/custom/jquery-3.6.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    {{-- Link Swiper's CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body>
    <div class="site-wrapper" id="top">
        @auth
            @include('frontend.fixed.modified_header')
        @else
            @include('frontend.fixed.default_header')
        @endauth

        {{-- Mobile Header Starts --}}
        @include('frontend.fixed.mobile_header')
        {{-- Mobile Header Ends --}}

        {{-- Sticky Header Starts --}}
        @include('frontend.fixed.sticky_header')
        {{-- Sticky Header Ends --}}

        @yield('content')
    </div>
    {{-- =================================
        Slider
    ===================================== --}}
    @include('frontend.fixed.payment')
    {{-- =================================
        Footer Area
    ===================================== --}}
    @include('frontend.fixed.footer')
    @include('frontend.fixed.frontend_javascripts')
</body>

</html>
