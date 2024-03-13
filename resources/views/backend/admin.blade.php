<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel for Books and Tutorials</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/frontend/image/favicon.ico') }}">
    <link href="{{ url('/backend/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ url('/custom/jquery-3.6.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    {{-- Link Swiper's CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body class="sb-nav-fixed">
    @include('backend.fixed.header')
    <div id="layoutSidenav">
        @include('backend.fixed.sidebar')
        {{-- layout side nave content --}}
        <div id="layoutSidenav_content">
            @yield('content')
            @include('backend.fixed.footer')
        </div>
    </div>
    @include('backend.fixed.backend_javasripts')
</body>

</html>
