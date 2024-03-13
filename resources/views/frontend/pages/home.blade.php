@extends('frontend.customer')
@section('content')
    {{-- =================================
        Hero Area
    ===================================== --}}
    <section class="hero-area hero-slider-3">
        <div class="sb-slick-slider"
            data-slick-setting='{
                "autoplay": true,
                "autoplaySpeed": 8000,
                "slidesToShow": 1,
                "dots":true
            }'>
            <div class="single-slide bg-image  bg-overlay--dark" data-bg="/frontend/image/bg-images/home-3-slider-1.jpg">
                <div class="container">
                    <div class="home-content text-center">
                        <div class="row justify-content-end">
                            <div class="col-lg-6">
                                <h1>Professional Books</h1>
                                <h2>Professionally designed and
                                    <br>Made environment friendly
                                </h2>
                                <a href="{{ route('botu.products.books') }}" class="btn btn--yellow">
                                    Shop Books Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slide bg-image  bg-overlay--dark" data-bg="/frontend/image/bg-images/home-3-slider-2.jpg">
                <div class="container">
                    <div class="home-content pl--30">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>Professional instructors</h1>
                                <h2>Easy to understand videos
                                    <br>And Exercise files
                                </h2>
                                <a href="{{ route('botu.products.tutorials') }}" class="btn btn--yellow">
                                    Shop Tutorials Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- =================================
        Home Category Gallery
    ===================================== --}}
    <section class="pt--30 section-margin">
        <h2 class="sr-only">Category Gallery Section</h2>
        <div class="container">
            <div class="category-gallery-block">
                <a href="{{ route('botu.products.list', [$rootCategories[5]->id, $rootCategories[5]->slug]) }}"
                    class="single-block hr-large" id="center-text" style="position: relative; transition:0.5s;">
                    <img src="/frontend/image/others/cat-gal-large.png" alt="Islamic Category Pic">
                    <span class="center-text-span" style="position:absolute; color:#62ab00;">ISLAMIC</span>
                </a>
                <div class="single-block inner-block-wrapper">
                    <a href="{{ route('botu.products.list', [$rootCategories[12]->id, $rootCategories[12]->slug]) }}"
                        class="single-image mid-image" id="center-text" style="position: relative;">
                        <img src="/frontend/image/others/cat-gal-mid.png" alt="Programming Category Pic">
                        <span class="center-text-span" style="position:absolute; color:#62ab00;">PROGRAMMING</span>
                    </a>
                    <a href="{{ route('botu.products.list', [$rootCategories[56]->id, $rootCategories[56]->slug]) }}"
                        class="single-image small-image"id="center-text" style="position: relative;">
                        <img src="/frontend/image/others/cat-gal-small.png" alt="Networking Category Pic">
                        <span class="center-text-span" style="position:absolute; color:#62ab00;">NETWORKING</span>
                    </a>
                    <a href="{{ route('botu.products.list', [$rootCategories[65]->id, $rootCategories[65]->slug]) }}"
                        class="single-image small-image" id="center-text" style="position: relative;">
                        <img src="/frontend/image/others/cat-gal-small-2.png" alt="Graphic Design Category Pic">
                        <span class="center-text-span" style="position:absolute; color:#62ab00;">GRAPHIC DESIGN</span>
                    </a>
                    <a href="{{ route('botu.products.list', [$rootCategories[17]->id, $rootCategories[17]->slug]) }}"
                        class="single-image mid-image" id="center-text" style="position: relative;">
                        <img src="/frontend/image/others/cat-gal-mid-2.png" alt="Web Category Pic">
                        <span class="center-text-span" style="position:absolute; color:#62ab00">WEB DESIGN AND
                            DEVELOPMENT</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- =================================
        ISLAMIC BOOKS & TUTORIALS
    ===================================== --}}
    <section class="section-margin">
        <div class="container">
            <div class="section-title section-title--bordered">
                <h2>ISLAMIC BOOKS & TUTORIALS</h2>
            </div>
            <div class="product-slider sb-slick-slider slider-border-single-row"
                data-slick-setting='{
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    "slidesToShow": 5,
                    "dots":true
                }'
                data-slick-responsive='[
                    {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                    {"breakpoint":992, "settings": {"slidesToShow": 3} },
                    {"breakpoint":768, "settings": {"slidesToShow": 2} },
                    {"breakpoint":480, "settings": {"slidesToShow": 1} },
                    {"breakpoint":320, "settings": {"slidesToShow": 1} }
                ]'>
                @foreach ($productsUnderIslamicCategory as $productUnderIslamicCategory)
                    <div class="single-slide">
                        <div class="product-card">
                            <div class="product-header">
                                <a href="{{ route('botu.author.instructor', $productUnderIslamicCategory->author) }}"
                                    class="author">
                                    {{ $productUnderIslamicCategory->author }}
                                </a>
                                <h3>
                                    @if ($productUnderIslamicCategory->type == 'Book')
                                        <a
                                            href="{{ route('botu.product.details', [$productUnderIslamicCategory->id, $productUnderIslamicCategory->slug]) }}">{{ $productUnderIslamicCategory->name }}</a>
                                    @else
                                        <a
                                            href="{{ route('botu.tutorial.details', [$productUnderIslamicCategory->id, $productUnderIslamicCategory->slug]) }}">{{ $productUnderIslamicCategory->name }}</a>
                                    @endif
                                </h3>
                            </div>
                            <div class="product-card--body">
                                <div class="card-image">
                                    @php
                                        $islamicImage = json_decode($productUnderIslamicCategory->image);
                                    @endphp
                                    @if (!empty($islamicImage[0]))
                                        <img src="{{ url('/uploads/product_images/' . $islamicImage[0]) }}" height="220"
                                            width="220" alt="Product Image">
                                    @else
                                        <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220" width="220"
                                            alt="No Image">
                                    @endif
                                    <div class="hover-contents">
                                        @if ($productUnderIslamicCategory->type == 'Book')
                                            <a href="{{ route('botu.product.details', [$productUnderIslamicCategory->id, $productUnderIslamicCategory->slug]) }}"
                                                class="hover-image">
                                                @if ($productUnderIslamicCategory->image != null)
                                                    @if (!empty($islamicImage[0]))
                                                        <img src="{{ url('/uploads/product_images/' . $islamicImage[0]) }}"
                                                            height="220" width="220" alt="Product Image">
                                                    @endif
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                            </a>
                                        @else
                                            <a href="{{ route('botu.tutorial.details', [$productUnderIslamicCategory->id, $productUnderIslamicCategory->slug]) }}"
                                                class="hover-image">
                                                @if ($productUnderIslamicCategory->image != null)
                                                    @if (!empty($islamicImage[0]))
                                                        <img src="{{ url('/uploads/product_images/' . $islamicImage[0]) }}"
                                                            height="220" width="220" alt="Product Image">
                                                    @endif
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                            </a>
                                        @endif
                                        <div class="hover-btns">
                                            <form
                                                action="{{ route('botu.add_to_cart', $productUnderIslamicCategory->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('botu.add_to_wishlist', $productUnderIslamicCategory->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </form>
                                            <button data-toggle="modal" type="button"
                                                class="single-btn product_details_modal"
                                                data-id="{{ $productUnderIslamicCategory->id }}"
                                                data-name="{{ $productUnderIslamicCategory->name }}"
                                                data-author="{{ $productUnderIslamicCategory->author }}"
                                                data-image="{{ $productUnderIslamicCategory->image }}"
                                                data-stock-status="{{ $productUnderIslamicCategory->stock_status }}"
                                                data-price="{{ $productUnderIslamicCategory->price }}"
                                                data-discount="{{ $productUnderIslamicCategory->discount }}"
                                                data-short-description="{{ $productUnderIslamicCategory->short_description }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="price-block">
                                    <span
                                        class="price">৳{{ $productUnderIslamicCategory->price - ($productUnderIslamicCategory->price * $productUnderIslamicCategory->discount) / 100 }}</span>
                                    <del class="price-old">৳{{ $productUnderIslamicCategory->price }}</del>
                                    <span class="price-discount">{{ $productUnderIslamicCategory->discount }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- =================================
        PROGRAMMING BOOKS & TUTORIALS
    ===================================== --}}
    <section class="section-margin">
        <div class="container">
            <div class="section-title section-title--bordered">
                <h2>PROGRAMMING BOOKS & TUTORIALS</h2>
            </div>
            <div class="product-slider sb-slick-slider slider-border-single-row"
                data-slick-setting='{
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    "slidesToShow": 5,
                    "dots":true
                }'
                data-slick-responsive='[
                    {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                    {"breakpoint":992, "settings": {"slidesToShow": 3} },
                    {"breakpoint":768, "settings": {"slidesToShow": 2} },
                    {"breakpoint":480, "settings": {"slidesToShow": 1} },
                    {"breakpoint":320, "settings": {"slidesToShow": 1} }
                ]'>
                @foreach ($productsUnderProgrammingCategory as $productUnderProgrammingCategory)
                    <div class="single-slide">
                        <div class="product-card">
                            <div class="product-header">
                                <a href="{{ route('botu.author.instructor', $productUnderProgrammingCategory->author) }}"
                                    class="author">
                                    {{ $productUnderProgrammingCategory->author }}
                                </a>
                                <h3>
                                    @if ($productUnderProgrammingCategory->type == 'Book')
                                        <a
                                            href="{{ route('botu.product.details', [$productUnderProgrammingCategory->id, $productUnderProgrammingCategory->slug]) }}">{{ $productUnderProgrammingCategory->name }}</a>
                                    @else
                                        <a
                                            href="{{ route('botu.tutorial.details', [$productUnderProgrammingCategory->id, $productUnderProgrammingCategory->slug]) }}">{{ $productUnderProgrammingCategory->name }}</a>
                                    @endif
                                </h3>
                            </div>
                            <div class="product-card--body">
                                <div class="card-image">
                                    @php
                                        $programmingImage = json_decode($productUnderProgrammingCategory->image);
                                    @endphp
                                    @if (!empty($programmingImage[0]))
                                        <img src="{{ url('/uploads/product_images/' . $programmingImage[0]) }}"
                                            height="220" width="220" alt="Product Image">
                                    @else
                                        <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                            width="220" alt="No Image">
                                    @endif
                                    <div class="hover-contents">
                                        @if ($productUnderProgrammingCategory->type == 'Book')
                                            <a href="{{ route('botu.product.details', [$productUnderProgrammingCategory->id, $productUnderProgrammingCategory->slug]) }}"
                                                class="hover-image">
                                                @if (!empty($programmingImage[0]))
                                                    <img src="{{ url('/uploads/product_images/' . $programmingImage[0]) }}"
                                                        height="220" width="220" alt="Product Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                            </a>
                                        @else
                                            <a href="{{ route('botu.tutorial.details', [$productUnderProgrammingCategory->id, $productUnderProgrammingCategory->slug]) }}"
                                                class="hover-image">
                                                @if (!empty($programmingImage[0]))
                                                    <img src="{{ url('/uploads/product_images/' . $programmingImage[0]) }}"
                                                        height="220" width="220" alt="Product Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                            </a>
                                        @endif
                                        <div class="hover-btns">
                                            <form
                                                action="{{ route('botu.add_to_cart', $productUnderProgrammingCategory->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('botu.add_to_wishlist', $productUnderProgrammingCategory->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </form>
                                            <a data-toggle="modal" class="single-btn product_details_modal"
                                                data-id="{{ $productUnderProgrammingCategory->id }}"
                                                data-name="{{ $productUnderProgrammingCategory->name }}"
                                                data-author="{{ $productUnderProgrammingCategory->author }}"
                                                data-image="{{ $productUnderProgrammingCategory->image }}"
                                                data-stock-status="{{ $productUnderProgrammingCategory->stock_status }}"
                                                data-price="{{ $productUnderProgrammingCategory->price }}"
                                                data-discount="{{ $productUnderProgrammingCategory->discount }}"
                                                data-short-description="{{ $productUnderProgrammingCategory->short_description }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="price-block">
                                    <span
                                        class="price">৳{{ $productUnderProgrammingCategory->price - ($productUnderProgrammingCategory->price * $productUnderProgrammingCategory->discount) / 100 }}</span>
                                    <del class="price-old">৳{{ $productUnderProgrammingCategory->price }}</del>
                                    <span class="price-discount">{{ $productUnderProgrammingCategory->discount }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- =================================
        WEB DESIGN AND DEVELOPMENT BOOKS & TUTORIALS
    ===================================== --}}
    <section class="section-margin">
        <div class="container">
            <div class="section-title section-title--bordered">
                <h2>WEB DESIGN AND DEVELOPMENT BOOKS & TUTORIALS</h2>
            </div>
            <div class="product-slider sb-slick-slider slider-border-single-row"
                data-slick-setting='{
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    "slidesToShow": 5,
                    "dots":true
                }'
                data-slick-responsive='[
                    {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                    {"breakpoint":992, "settings": {"slidesToShow": 3} },
                    {"breakpoint":768, "settings": {"slidesToShow": 2} },
                    {"breakpoint":480, "settings": {"slidesToShow": 1} },
                    {"breakpoint":320, "settings": {"slidesToShow": 1} }
                ]'>
                @foreach ($productsUnderWebCategory as $productUnderWebCategory)
                    <div class="single-slide">
                        <div class="product-card">
                            <div class="product-header">
                                <a href="{{ route('botu.author.instructor', $productUnderWebCategory->author) }}"
                                    class="author">
                                    {{ $productUnderWebCategory->author }}
                                </a>
                                <h3>
                                    @if ($productUnderWebCategory->type == 'Book')
                                        <a
                                            href="{{ route('botu.product.details', [$productUnderWebCategory->id, $productUnderWebCategory->slug]) }}">{{ $productUnderWebCategory->name }}</a>
                                    @else
                                        <a
                                            href="{{ route('botu.tutorial.details', [$productUnderWebCategory->id, $productUnderWebCategory->slug]) }}">{{ $productUnderWebCategory->name }}</a>
                                    @endif
                                </h3>
                            </div>
                            <div class="product-card--body">
                                <div class="card-image">
                                    @php
                                        $webImage = json_decode($productUnderWebCategory->image);
                                    @endphp
                                    @if (!empty($webImage[0]))
                                        <img src="{{ url('/uploads/product_images/' . $webImage[0]) }}" height="220"
                                            width="220" alt="Product Image">
                                    @else
                                        <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                            width="220" alt="No Image">
                                    @endif
                                    <div class="hover-contents">
                                        @if ($productUnderWebCategory->type == 'Book')
                                            <a href="{{ route('botu.product.details', [$productUnderWebCategory->id, $productUnderWebCategory->slug]) }}"
                                                class="hover-image">
                                                @if (!empty($webImage[0]))
                                                    <img src="{{ url('/uploads/product_images/' . $webImage[0]) }}"
                                                        height="220" width="220" alt="Product Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                            </a>
                                        @else
                                            <a href="{{ route('botu.tutorial.details', [$productUnderWebCategory->id, $productUnderWebCategory->slug]) }}"
                                                class="hover-image">
                                                @if (!empty($webImage[0]))
                                                    <img src="{{ url('/uploads/product_images/' . $webImage[0]) }}"
                                                        height="220" width="220" alt="Product Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                            </a>
                                        @endif
                                        <div class="hover-btns">
                                            <form action="{{ route('botu.add_to_cart', $productUnderWebCategory->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('botu.add_to_wishlist', $productUnderWebCategory->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </form>
                                            <a data-toggle="modal" class="single-btn product_details_modal"
                                                data-id="{{ $productUnderWebCategory->id }}"
                                                data-name="{{ $productUnderWebCategory->name }}"
                                                data-author="{{ $productUnderWebCategory->author }}"
                                                data-image="{{ $productUnderWebCategory->image }}"
                                                data-stock-status="{{ $productUnderWebCategory->stock_status }}"
                                                data-price="{{ $productUnderWebCategory->price }}"
                                                data-discount="{{ $productUnderWebCategory->discount }}"
                                                data-short-description="{{ $productUnderWebCategory->short_description }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="price-block">
                                    <span
                                        class="price">৳{{ $productUnderWebCategory->price - ($productUnderWebCategory->price * $productUnderWebCategory->discount) / 100 }}</span>
                                    <del class="price-old">৳{{ $productUnderWebCategory->price }}</del>
                                    <span class="price-discount">{{ $productUnderWebCategory->discount }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- =================================
        Promotion Section One
    ===================================== --}}
    <section class="section-margin">
        <h1 class="sr-only">Promotion Section</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a href="javascript:void(0)" style="pointer-events: none; cursor: default;"
                        class="promo-image promo-overlay">
                        <img src="/frontend/image/bg-images/promo-banner-with-text.jpg" alt="Buy 4 Get 1 Free">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="{{ route('botu.free.tutorials') }}" class="promo-image promo-overlay">
                        <img src="/frontend/image/bg-images/promo-banner-with-text-2.jpg" alt="Free Tutorials">
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- =================================
        Home Two Column Section
    ===================================== --}}
    <section class="bg-gray section-padding-top section-padding-bottom section-margin">
        <h1 class="sr-only">Promotion Section</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="home-left-sidebar">
                        <div class="single-side  bg-white">
                            <h2 class="home-sidebar-title">
                                Special offer
                            </h2>
                            <div class="product-slider countdown-single with-countdown sb-slick-slider product-border-reset"
                                data-slick-setting='{
                                    "autoplay": true,
                                    "autoplaySpeed": 8000,
                                    "slidesToShow": 1,
                                    "dots":true
                                }'
                                data-slick-responsive='[
                                    {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                    {"breakpoint":575, "settings": {"slidesToShow": 2} },
                                    {"breakpoint":480, "settings": {"slidesToShow": 1} }
                                ]'>
                                @foreach ($special_offer_products as $special_offer_product)
                                    <div class="single-slide">
                                        <div class="product-card">
                                            <div class="product-header">
                                                <a href="{{ route('botu.author.instructor', $special_offer_product->author) }}"
                                                    class="author">
                                                    {{ $special_offer_product->author }}
                                                </a>
                                                <h3>
                                                    @if ($special_offer_product->type == 'Book')
                                                        <a
                                                            href="{{ route('botu.product.details', [$special_offer_product->id, $special_offer_product->slug]) }}">{{ $special_offer_product->name }}</a>
                                                    @else
                                                        <a
                                                            href="{{ route('botu.tutorial.details', [$special_offer_product->id, $special_offer_product->slug]) }}">{{ $special_offer_product->name }}</a>
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="product-card--body">
                                                <div class="card-image">
                                                    @php
                                                        $specialOfferImage = json_decode($special_offer_product->image);
                                                    @endphp
                                                    @if (!empty($specialOfferImage[0]))
                                                        <img src="{{ url('/uploads/product_images/' . $specialOfferImage[0]) }}"
                                                            height="352" width="352" alt="Product Image">
                                                    @else
                                                        <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                            height="352" width="352" alt="No Image">
                                                    @endif
                                                    <div class="hover-contents">
                                                        @if ($special_offer_product->type == 'Book')
                                                            <a href="{{ route('botu.product.details', [$special_offer_product->id, $special_offer_product->slug]) }}"
                                                                class="hover-image">
                                                                @if (!empty($specialOfferImage[0]))
                                                                    <img src="{{ url('/uploads/product_images/' . $specialOfferImage[0]) }}"
                                                                        height="352" width="352"
                                                                        alt="Product Image">
                                                                @else
                                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                        height="352" width="352" alt="No Image">
                                                                @endif
                                                            </a>
                                                        @else
                                                            <a href="{{ route('botu.tutorial.details', [$special_offer_product->id, $special_offer_product->slug]) }}"
                                                                class="hover-image">
                                                                @if (!empty($specialOfferImage[0]))
                                                                    <img src="{{ url('/uploads/product_images/' . $specialOfferImage[0]) }}"
                                                                        height="352" width="352"
                                                                        alt="Product Image">
                                                                @else
                                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                        height="352" width="352" alt="No Image">
                                                                @endif
                                                            </a>
                                                        @endif
                                                        <div class="hover-btns">
                                                            <form
                                                                action="{{ route('botu.add_to_cart', $special_offer_product->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="single-btn">
                                                                    <i class="fas fa-shopping-basket"></i>
                                                                </button>
                                                            </form>
                                                            <form
                                                                action="{{ route('botu.add_to_wishlist', $special_offer_product->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="single-btn">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                            </form>
                                                            <a data-toggle="modal"
                                                                class="single-btn product_details_modal"
                                                                data-id="{{ $special_offer_product->id }}"
                                                                data-name="{{ $special_offer_product->name }}"
                                                                data-author="{{ $special_offer_product->author }}"
                                                                data-image="{{ $special_offer_product->image }}"
                                                                data-stock-status="{{ $special_offer_product->stock_status }}"
                                                                data-price="{{ $special_offer_product->price }}"
                                                                data-discount="{{ $special_offer_product->discount }}"
                                                                data-short-description="{{ $special_offer_product->short_description }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="price-block">
                                                    <span
                                                        class="price">৳{{ $special_offer_product->price - ($special_offer_product->price * $special_offer_product->discount) / 100 }}</span>
                                                    <del class="price-old">৳{{ $special_offer_product->price }}</del>
                                                    <span
                                                        class="price-discount">{{ $special_offer_product->discount }}%</span>
                                                </div>
                                                <div class="count-down-block">
                                                    <div class="product-countdown" data-countdown="01/05/2023">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="single-side">
                            <a href="{{ route('botu.free.books') }}" class="promo-image promo-overlay">
                                <img src="/frontend/image/bg-images/promo-banner-small-with-text.jpg" alt="Free Books">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="home-right-block bg-white">
                        <div class="sb-custom-tab   pt--30 pb--30">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="shop-tab" data-toggle="tab"
                                        href="#featured_products" role="tab" aria-controls="shop"
                                        aria-selected="true">
                                        Featured Products
                                    </a>
                                    <span class="arrow-icon"></span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="men-tab" data-toggle="tab" href="#new_arrivals"
                                        role="tab" aria-controls="men" aria-selected="true">
                                        New Arrivals
                                    </a>
                                    <span class="arrow-icon"></span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="woman-tab" data-toggle="tab" href="#most_viewed_products"
                                        role="tab" aria-controls="woman" aria-selected="false">
                                        Most viewed products
                                    </a>
                                    <span class="arrow-icon"></span>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                {{-- <div class="tab-pane show active" id="shop" role="tabpanel"
                                    aria-labelledby="shop-tab"> 16 products total --}}
                                <div class="tab-pane active" id="featured_products" role="tabpanel"
                                    aria-labelledby="shop-tab">
                                    <div class="product-slider product-list-slider multiple-row slider-border-multiple-row  sb-slick-slider"
                                        data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 2,
                                            "rows":4,
                                            "dots":true
                                        }'
                                        data-slick-responsive='[
                                            {"breakpoint":992, "settings": {"slidesToShow": 2,"rows": 3} },
                                            {"breakpoint":768, "settings": {"slidesToShow": 1} }
                                        ]'>
                                        @foreach ($featured_products as $featured_product)
                                            <div class="single-slide">
                                                <div class="product-card card-style-list">
                                                    <div class="card-image">
                                                        @php
                                                            $featuredImage = json_decode($featured_product->image);
                                                        @endphp
                                                        @if (!empty($featuredImage[0]))
                                                            <img src="{{ url('/uploads/product_images/' . $featuredImage[0]) }}"
                                                                height="150" width="150" alt="Product Image">
                                                        @else
                                                            <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                height="150" width="150" alt="No Image">
                                                        @endif
                                                    </div>
                                                    <div class="product-card--body">
                                                        <div class="product-header">
                                                            <a href="{{ route('botu.author.instructor', $featured_product->author) }}"
                                                                class="author">
                                                                {{ $featured_product->author }}
                                                            </a>
                                                            <h3>
                                                                @if ($featured_product->type == 'Book')
                                                                    <a
                                                                        href="{{ route('botu.product.details', [$featured_product->id, $featured_product->slug]) }}">{{ $featured_product->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('botu.tutorial.details', [$featured_product->id, $featured_product->slug]) }}">{{ $featured_product->name }}</a>
                                                                @endif
                                                            </h3>
                                                        </div>
                                                        <div class="price-block">
                                                            <span
                                                                class="price">৳{{ $featured_product->price - ($featured_product->price * $featured_product->discount) / 100 }}</span>
                                                            <del class="price-old">৳{{ $featured_product->price }}</del>
                                                            <span
                                                                class="price-discount">{{ $featured_product->discount }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('botu.products.featured') }}" class="btn btn-warning">View
                                        More</a>
                                </div>
                                <div class="tab-pane" id="new_arrivals" role="tabpanel" aria-labelledby="men-tab">
                                    <div class="product-slider product-list-slider multiple-row slider-border-multiple-row  sb-slick-slider"
                                        data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 2,
                                            "rows":4,
                                            "dots":true
                                        }'
                                        data-slick-responsive='[
                                            {"breakpoint":992, "settings": {"slidesToShow": 2,"rows": 3} },
                                            {"breakpoint":768, "settings": {"slidesToShow": 1} }
                                        ]'>
                                        @foreach ($new_arrivals_products as $new_arrivals_product)
                                            <div class="single-slide">
                                                <div class="product-card card-style-list">
                                                    <div class="card-image">
                                                        @php
                                                            $newArrivalsImage = json_decode($new_arrivals_product->image);
                                                        @endphp
                                                        @if (!empty($newArrivalsImage[0]))
                                                            <img src="{{ url('/uploads/product_images/' . $newArrivalsImage[0]) }}"
                                                                height="150" width="150" alt="Product Image">
                                                        @else
                                                            <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                height="150" width="150" alt="No Image">
                                                        @endif
                                                    </div>
                                                    <div class="product-card--body">
                                                        <div class="product-header">
                                                            <a href="{{ route('botu.author.instructor', $new_arrivals_product->author) }}"
                                                                class="author">
                                                                {{ $new_arrivals_product->author }}
                                                            </a>
                                                            <h3>
                                                                @if ($new_arrivals_product->type == 'Book')
                                                                    <a
                                                                        href="{{ route('botu.product.details', [$new_arrivals_product->id, $new_arrivals_product->slug]) }}">{{ $new_arrivals_product->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('botu.tutorial.details', [$new_arrivals_product->id, $new_arrivals_product->slug]) }}">{{ $new_arrivals_product->name }}</a>
                                                                @endif
                                                            </h3>
                                                        </div>
                                                        <div class="price-block">
                                                            <span
                                                                class="price">৳{{ $new_arrivals_product->price - ($new_arrivals_product->price * $new_arrivals_product->discount) / 100 }}</span>
                                                            <del
                                                                class="price-old">৳{{ $new_arrivals_product->price }}</del>
                                                            <span
                                                                class="price-discount">{{ $new_arrivals_product->discount }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('botu.products.new_arrivals') }}" class="btn btn-warning">View
                                        More</a>
                                </div>
                                <div class="tab-pane" id="most_viewed_products" role="tabpanel"
                                    aria-labelledby="woman-tab">
                                    <div class="product-slider product-list-slider multiple-row slider-border-multiple-row  sb-slick-slider"
                                        data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 2,
                                            "rows":4,
                                            "dots":true
                                        }'
                                        data-slick-responsive='[
                                            {"breakpoint":992, "settings": {"slidesToShow": 2,"rows": 3} },
                                            {"breakpoint":768, "settings": {"slidesToShow": 1} }
                                        ]'>
                                        @foreach ($most_viewed_products as $most_viewed_product)
                                            <div class="single-slide">
                                                <div class="product-card card-style-list">
                                                    <div class="card-image">
                                                        @php
                                                            $mostViewdImage = json_decode($most_viewed_product->image);
                                                        @endphp
                                                        @if (!empty($mostViewdImage[0]))
                                                            <img src="{{ url('/uploads/product_images/' . $mostViewdImage[0]) }}"
                                                                height="150" width="150" alt="Product Image">
                                                        @else
                                                            <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                height="150" width="150" alt="No Image">
                                                        @endif
                                                    </div>
                                                    <div class="product-card--body">
                                                        <div class="product-header">
                                                            <a href="{{ route('botu.author.instructor', $most_viewed_product->author) }}"
                                                                class="author">
                                                                {{ $most_viewed_product->author }}
                                                            </a>
                                                            <h3>
                                                                @if ($most_viewed_product->type == 'Book')
                                                                    <a
                                                                        href="{{ route('botu.product.details', [$most_viewed_product->id, $most_viewed_product->slug]) }}">{{ $most_viewed_product->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('botu.tutorial.details', [$most_viewed_product->id, $most_viewed_product->slug]) }}">{{ $most_viewed_product->name }}</a>
                                                                @endif
                                                            </h3>
                                                        </div>
                                                        <div class="price-block">
                                                            <span
                                                                class="price">৳{{ $most_viewed_product->price - ($most_viewed_product->price * $most_viewed_product->discount) / 100 }}</span>
                                                            <del
                                                                class="price-old">৳{{ $most_viewed_product->price }}</del>
                                                            <span
                                                                class="price-discount">{{ $most_viewed_product->discount }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('botu.products.most_viewed') }}" class="btn btn-warning">View
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- =================================
        CLIENT TESTIMONIALS
    ===================================== --}}
    <section class="section-margin">
        <div class="container">
            <div class="section-title section-title--bordered mb-lg--60">
                <h2>CLIENT TESTIMONIALS</h2>
            </div>
            <div class="sb-slick-slider testimonial-slider"
                data-slick-setting='{
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    "slidesToShow":3,
                    "dots":true
                }'
                data-slick-responsive='[
                    {"breakpoint":1200, "settings": {"slidesToShow": 2} },
                    {"breakpoint":992, "settings": {"slidesToShow": 1} },
                    {"breakpoint":768, "settings": {"slidesToShow": 1} },
                    {"breakpoint":490, "settings": {"slidesToShow": 1} }
                ]'>
                @forelse ($user_reviews as $user_review)
                    <div class="single-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-image">
                                @if (!empty($user_review->user->image))
                                    <img src="{{ url('/uploads/users/' . $user_review->user->image) }}" height="100"
                                        width="100" alt="User Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                            </div>
                            <div class="testimonial-body">
                                <article>
                                    <h2 class="sr-only">Testimonial Article</h2>
                                    <p>{{ $user_review->message }}</p>
                                    <span class="d-block client-name">
                                        @if (!empty($user_review->user))
                                            {{ $user_review->user->first_name }}
                                            {{ $user_review->user->last_name }}
                                        @endif
                                    </span>
                                </article>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="single-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-body">
                                <article>
                                    <h2 class="sr-only">Testimonial Article</h2>
                                    <p class="alert alert-danger">No Testimonial Found</p>
                                </article>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    {{-- Product Details Modal --}}
    @include('frontend.fixed.product_details_modal')
    {{-- =================================
        Home Features Section
    ===================================== --}}
    <section class="mb--30 space-dt--30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="text">
                            <h5>Free Shipping Item</h5>
                            <p> Orders over ৳5000</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-redo-alt"></i>
                        </div>
                        <div class="text">
                            <h5>Happy Return</h5>
                            <p>7 days return facility</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="text">
                            <h5>Cash On Delivery</h5>
                            <p>Pay cash at your doorstep</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <div class="text">
                            <h5>Help & Support</h5>
                            <p>Call us: +880 12345-67890</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- =================================
        Footer
    ===================================== --}}
@endsection
