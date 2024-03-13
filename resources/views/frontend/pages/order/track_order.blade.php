@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Track</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- order track Page Start --}}
    <div style="margin-top:100px; margin-bottom:100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <h1>Enter Order Number</h1>
                    <form action="{{ route('botu.order.track.number') }}" method="GET">
                        @csrf
                        <div style="padding-bottom: 20px">
                            <label for="order_id"></label>
                            <input type="number" name="order_id" id="order_id" class="form-control"
                                placeholder="Enter order number" required>
                        </div>
                        <div style="font-size: 1.5rem;">
                            <input type="submit" value="Search" class="btn btn--primary form-control">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
        </div>
    </div>
    {{-- order track Page Start --}}
@endsection()
