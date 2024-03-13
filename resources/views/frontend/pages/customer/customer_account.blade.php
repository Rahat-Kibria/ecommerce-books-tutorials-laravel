@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <div class="page-section inner-page-sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        {{-- My Account Tab Menu Start --}}
                        @include('frontend.fixed.customer_sidebar')
                        {{-- My Account Tab Menu End --}}
                        {{-- My Account Tab Content Start --}}
                        @yield('content_customer')
                        {{-- My Account Tab Content End --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
