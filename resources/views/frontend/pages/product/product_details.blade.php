@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main class="inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row  mb--60">
                <div class="col-lg-5 mb--30">
                    @php
                        $productImage = json_decode($product_details->image);
                    @endphp
                    {{-- Product Details Slider Big Image --}}
                    <div class="product-details-slider sb-slick-slider arrow-type-two"
                        data-slick-setting='{
                            "slidesToShow": 1,
                            "arrows": false,
                            "fade": true,
                            "draggable": false,
                            "swipe": false,
                            "asNavFor": ".product-slider-nav"
                        }'>
                        @foreach ($productImage as $image)
                            <div class="single-slide">
                                <img src="{{ url('/uploads/product_images/' . $image) }}" alt="Product Image 1">
                            </div>
                        @endforeach
                    </div>
                    {{-- Product Details Slider Nav --}}
                    <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two"
                        data-slick-setting='{
                            "infinite":true,
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 4,
                            "arrows": true,
                            "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
                            "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
                            "asNavFor": ".product-details-slider",
                            "focusOnSelect": true
                        }'>
                        @foreach ($productImage as $image)
                            <div class="single-slide">
                                <img src="{{ url('/uploads/product_images/' . $image) }}" alt="Product Image 1">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product-details-info pl-lg--30 ">
                        <p class="tag-block">Tags: <a href="#">Category1</a>, <a href="#">Category2</a></p>
                        <h3 class="product-title">{{ $product_details->name }}</h3>
                        <ul class="list-unstyled">
                            <li>Author: <a href="#" class="list-value font-weight-bold">
                                    {{ $product_details->author }}</a></li>
                            <li>Stock Status: <span class="list-value"> {{ $product_details->stock_status }}</span></li>
                        </ul>
                        <div class="price-block">
                            <span
                                class="price-new">৳{{ $product_details->price - ($product_details->price * $product_details->discount) / 100 }}</span>
                            <del class="price-old">৳{{ $product_details->price }}</del>
                        </div>
                        <div class="rating-widget">
                            <div class="rating-block">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="fas fa-star {{ $i <= $avg_rating ? 'star_on' : '' }}"></span>
                                @endfor
                            </div>
                            <div class="review-widget">
                                <a href="javacript:" id="write_review_from">({{ $total_reviews }} Reviews)</a>
                                <span>|</span>
                                <a href="javacript:" id="write_review_from2">Write a review</a>
                            </div>
                        </div>
                        <article class="product-details-article">
                            <h4 class="sr-only">Product Summery</h4>
                            <p>{!! $product_details->short_description !!}</p>
                        </article>
                        @if ($product_details->stock_status == 'Available')
                            <form action="{{ route('botu.cart.update.single', $product_details->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="add-to-cart-row">
                                    <div class="count-input-block">
                                        <span class="widget-label">Qty</span>
                                        <input type="number" name="quantity" class="form-control text-center"
                                            value="1">
                                    </div>
                                    <div class="add-cart-btn">
                                        <button type="submit" class="btn btn-outlined--primary">
                                            <span class="plus-icon">+</span>Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="add-to-cart-row">
                                <div class="add-cart-btn">
                                    <a href="javascript:void(0)" style="pointer-events: none; cursor: default;"
                                        class="btn btn-outlined--primary">Out of Stock</a>
                                </div>
                            </div>
                        @endif
                        <div class="compare-wishlist-row">
                            <form action="{{ route('botu.add_to_wishlist', $product_details->id) }}" method="post">
                                @csrf
                                <button type="submit" class="add-link"><i class="fas fa-heart"></i>Add to Wish
                                    List</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    @php
                        $audio_book = \App\Models\Audio::where('product_id', $product_details->id)->first();
                        $ebook = \App\Models\Ebook::where('product_id', $product_details->id)->first();
                    @endphp
                    @if (isset($audio_book) && !empty($audio_book))
                        <div style="padding: 20px 0;">
                            <img src="{{ asset('frontend/image/bg-images/free-audio-book.png') }}" alt="Free audio book">
                        </div>
                    @endif
                    @if (isset($ebook) && !empty($ebook))
                        <div style="padding: 20px 0;">
                            <img src="{{ asset('frontend/image/bg-images/free-ebook.png') }}" alt="Free ebook">
                        </div>
                    @endif
                </div>
            </div>
            <div class="sb-custom-tab review-tab section-padding">
                <div style="border-bottom: 1px solid #999; text-align: center; margin-bottom: 20px;">
                    <h3>DESCRIPTION</h3>
                </div>
                <article class="review-article">
                    <h1 class="sr-only">{{ $product_details->name }}</h1>
                    <p>{!! $product_details->description !!}</p>
                </article>
                <br><br>
                <div id="write_review_to" style="border-bottom: 1px solid #999; text-align: center; margin-bottom: 20px;">
                    <h3>REVIEWS ({{ $total_reviews }})</h3>
                </div>
                <div class="review-wrapper">
                    <h2 class="title-lg mb--20" style="text-transform: uppercase;">{{ $total_reviews }} REVIEWS for
                        {{ $product_details->name }}</h2>
                    @forelse ($product_reviews as $product_review)
                        <div class="review-comment mb--20">
                            <div class="avatar">
                                @if (!empty($product_review->user->image))
                                    <img src="{{ url('/uploads/users/' . $product_review->user->image) }}"
                                        alt="User Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" alt="No Image">
                                @endif
                            </div>
                            <div class="text">
                                <div class="rating-block mb--15">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="ion-android-star-outline {{ $i <= $product_review->rating ? 'star_on' : '' }}"></span>
                                    @endfor
                                </div>
                                <h6 class="author" style="text-transform: uppercase;">
                                    {{ $product_review->user->first_name }} {{ $product_review->user->last_name }} –
                                    <span
                                        class="font-weight-400">{{ $product_review->created_at->format('M d, Y') }}</span>
                                </h6>
                                <p>{{ $product_review->message }}</p>
                            </div>
                        </div>
                    @empty
                        <div>
                            <p class="alert alert-danger">No Rating Reviews Found</p>
                            <p class="alert alert-info">Be the first to review by purchasing our product</p>
                        </div>
                    @endforelse
                    {{ $product_reviews->links() }}
                    <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                    <div class="rating-row pt-2">
                        <p class="d-block">Your Rating *</p>
                        <span class="rating-widget-block">
                            <input type="radio" name="rating" id="star1" value="5"
                                form="review_rating_form" required>
                            <label for="star1"></label>
                            <input type="radio" name="rating" id="star2" value="4"
                                form="review_rating_form" required>
                            <label for="star2"></label>
                            <input type="radio" name="rating" id="star3" value="3"
                                form="review_rating_form" required>
                            <label for="star3"></label>
                            <input type="radio" name="rating" id="star4" value="2"
                                form="review_rating_form" required>
                            <label for="star4"></label>
                            <input type="radio" name="rating" id="star5" value="1"
                                form="review_rating_form" required>
                            <label for="star5"></label>
                        </span>
                        @if ($errors->has('rating'))
                            @foreach ($errors->get('rating') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                        <form action="{{ route('botu.product.review') }}" class="mt--15 site-form "
                            id="review_rating_form" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="message">Comment *</label>
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                    @if ($errors->has('message'))
                                        @foreach ($errors->get('message') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <input type="hidden" name="product_id" value="{{ $product_details->id }}" required>
                                    @if ($errors->has('product_id'))
                                        @foreach ($errors->get('product_id') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            required>
                                    </div>
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-8">
                                </div>
                                <div class="col-lg-12">
                                    <div class="submit-btn">
                                        <button type="submit" class="btn btn-black">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- =================================
            RELATED PRODUCTS BOOKS
        ===================================== --}}
        <section class="">
            <div class="container">
                <div class="section-title section-title--bordered">
                    <h2>RELATED PRODUCTS</h2>
                </div>
                <div class="product-slider sb-slick-slider slider-border-single-row"
                    data-slick-setting='{
                        "autoplay": true,
                        "autoplaySpeed": 8000,
                        "slidesToShow": 4,
                        "dots":true
                    }'
                    data-slick-responsive='[
                        {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                        {"breakpoint":992, "settings": {"slidesToShow": 3} },
                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                        {"breakpoint":480, "settings": {"slidesToShow": 1} }
                    ]'>
                    @forelse ($related_products as $related_product)
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="#" class="author">
                                        {{ $related_product->author }}
                                    </a>
                                    <h3><a
                                            href="{{ route('botu.product.details', [$related_product->id, $related_product->slug]) }}">Revolutionize
                                            Your BOOK With</a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        @php
                                            $product_image = json_decode($related_product->image);
                                        @endphp
                                        @if (!empty($product_image[0]))
                                            <img src="{{ url('/uploads/product_images/' . $product_image[0]) }}"
                                                height="275" width="275" alt="Product Image">
                                        @else
                                            <img src="{{ url('/uploads/default/no_image.jpg') }}" height="275"
                                                width="275" alt="No Image">
                                        @endif
                                        <div class="hover-contents">
                                            <a href="{{ route('botu.product.details', [$related_product->id, $related_product->slug]) }}"
                                                class="hover-image">
                                                @if (!empty($product_image[0]))
                                                    <img src="{{ url('/uploads/product_images/' . $product_image[0]) }}"
                                                        height="275" width="275" alt="Product Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="275"
                                                        width="275" alt="No Image">
                                                @endif
                                            </a>
                                            <div class="hover-btns">
                                                <form action="{{ route('botu.add_to_cart', $related_product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="single-btn">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('botu.add_to_wishlist', $related_product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="single-btn">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                </form>
                                                <a data-toggle="modal" class="single-btn product_details_modal"
                                                    data-id="{{ $related_product->id }}"
                                                    data-name="{{ $related_product->name }}"
                                                    data-author="{{ $related_product->author }}"
                                                    data-image="{{ $related_product->image }}"
                                                    data-stock-status="{{ $related_product->stock_status }}"
                                                    data-price="{{ $related_product->price }}"
                                                    data-discount="{{ $related_product->discount }}"
                                                    data-short-description="{{ $related_product->short_description }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span
                                            class="price">৳{{ $related_product->price - ($related_product->price * $related_product->discount) / 100 }}</span>
                                        <del class="price-old">৳{{ $related_product->price }}</del>
                                        <span class="price-discount">{{ $related_product->discount }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div>
                            <p class="alert alert-danger" style="font-size: 1rem; text-align: center;">Sorry No Related
                                Products found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        {{-- Product Details Modal --}}
        @include('frontend.fixed.product_details_modal')
    </main>
@endsection
