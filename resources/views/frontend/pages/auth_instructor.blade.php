@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Author/Instructor</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main class="inner-page-sec-padding-bottom">
        <div class="container">
            @php
                $contents_count = App\Models\Product::where('author', $auth_instructor->author)->count();
                $products = App\Models\Product::where('author', $auth_instructor->author)->get();
            @endphp
            <div style="border-bottom: 1px solid #999; text-align: center; margin-bottom: 20px;">
                <h1 style="font-weight: bolder;">{{ $auth_instructor->author }}</h1>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <h3>No. of Contents</h3>
                    <span class="price">{{ $contents_count }}</span>
                </div>
                <div class="col-lg-8">
                    <h3 style="background-color: #62ab00; padding: 10px">Contents List</h3>
                    <div class="single-block">
                        <ul class="sidebar-menu--shop menu-type-2">
                            @forelse ($products as $product)
                                @php
                                    $image = json_decode($product->image);
                                @endphp
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            @if ($product->type == 'Book')
                                                <a style="font-size: 1.5rem;"
                                                    href="{{ route('botu.product.details', [$product->id, $product->slug]) }}">
                                                    <img src="{{ asset('uploads/product_images/' . $image[0]) }}"
                                                        height="70" width="60" alt="product image">
                                                </a>
                                            @else
                                                <a style="font-size: 1.5rem;"
                                                    href="{{ route('botu.tutorial.details', [$product->id, $product->slug]) }}">
                                                    <img src="{{ asset('uploads/product_images/' . $image[0]) }}"
                                                        height="70" width="60" alt="product image">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-lg-5" style="padding: 45px 0;">
                                            @if ($product->type == 'Book')
                                                <a style="font-size: 1.5rem;"
                                                    href="{{ route('botu.product.details', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                                            @else
                                                <a style="font-size: 1.5rem;"
                                                    href="{{ route('botu.tutorial.details', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                                            @endif
                                        </div>
                                        <div class="col-lg-4" style="padding: 45px 0;">
                                            <span
                                                class="price">৳{{ $product->price - ($product->price * $product->discount) / 100 }}</span>
                                            <del class="price-old">৳{{ $product->price }}</del>
                                            <span class="price-discount">{{ $product->discount }} %</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li><a href="javascript:" class="alert alert-danger">Nothing Found <span>(0)</span></a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
