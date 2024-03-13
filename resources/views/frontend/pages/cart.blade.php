@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    {{-- Cart Page Start --}}
    <main class="cart-page-main-block inner-page-sec-padding-bottom">
        <div class="cart_area cart-area-padding  ">
            <div class="container">
                <div class="page-section-title">
                    <h1>Shopping Cart</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{-- Cart Table --}}
                        <div class="cart-table table-responsive mb--40">
                            <table class="table">
                                {{-- Head Row --}}
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Sub Total</th>
                                        <th class="pro-subtotal">Status</th>
                                        <th class="pro-remove">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('botu.cart.update.multi') }}" method="post" id="cart_form">
                                        @csrf
                                        @method('put')
                                        {{-- Product Row --}}
                                        @forelse ($cart_products as $cart_product)
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    @php
                                                        $cart_image = json_decode($cart_product->product->image);
                                                        $product_price = $cart_product->product->price - ($cart_product->product->price * $cart_product->product->discount) / 100;
                                                    @endphp
                                                    @if ($cart_product->product->type == 'Book')
                                                        <a
                                                            href="{{ route('botu.product.details', [$cart_product->product->id, $cart_product->product->slug]) }}">
                                                            <img src="{{ url('/uploads/product_images/' . $cart_image[0]) }}"
                                                                alt="Product">
                                                        </a>
                                                    @else
                                                        <a
                                                            href="{{ route('botu.tutorial.details', [$cart_product->product->id, $cart_product->product->slug]) }}">
                                                            <img src="{{ url('/uploads/product_images/' . $cart_image[0]) }}"
                                                                alt="Product">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="pro-title">
                                                    @if ($cart_product->product->type == 'Book')
                                                        <a
                                                            href="{{ route('botu.product.details', [$cart_product->product->id, $cart_product->product->slug]) }}">{{ $cart_product->product->name }}</a>
                                                    @else
                                                        <a
                                                            href="{{ route('botu.tutorial.details', [$cart_product->product->id, $cart_product->product->slug]) }}">{{ $cart_product->product->name }}</a>
                                                    @endif
                                                </td>
                                                <td class="pro-price"><span>৳{{ $product_price }}</span>
                                                </td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty">
                                                        <div class="count-input-block">
                                                            <input type="number" class="form-control text-center"
                                                                name="quantity[]" value="{{ $cart_product->quantity }}">
                                                            <input type="hidden" class="form-control text-center"
                                                                name="cart_id[]" value="{{ $cart_product->id }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span>৳{{ $cart_product->quantity * $product_price }}</span>
                                                </td>
                                                <td class="pro-subtotal">
                                                    @if ($cart_product->product->stock_status == 'Available')
                                                        <span
                                                            class="btn-sm btn-success rounded-pill">{{ $cart_product->product->stock_status }}</span>
                                                    @else
                                                        <span
                                                            class="btn-sm btn-danger rounded-pill">{{ $cart_product->product->stock_status }}</span>
                                                    @endif
                                                </td>
                                                <td class="pro-remove"><a
                                                        href="{{ route('botu.cart.delete', $cart_product->id) }}"
                                                        onclick="return confirm('Are your sure?')"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <p class="alert alert-danger">No Products Available. <a
                                                            href="{{ route('botu') }}">Browse for Products</a></p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </form>
                                    {{-- Discount Row  --}}
                                    <tr>
                                        <td colspan="8" class="actions">
                                            @if (session()->has('coupon'))
                                                <div class="coupon-block">
                                                    <div class="coupon-text">
                                                        <span class="btn btn-warning"
                                                            style="font-size: 1rem;">{{ session()->get('coupon')['coupon_code'] }}
                                                            ({{ session()->get('coupon')['coupon_discount'] }}%
                                                            OFF)</span>
                                                    </div>
                                                    <div class="coupon-btn">
                                                        <a href="{{ route('botu.clear.session') }}"
                                                            class="btn btn-outlined"
                                                            onclick="return confirm('Are your sure?')">Remove coupon</a>
                                                    </div>
                                                </div>
                                            @else
                                                <form action="{{ route('botu.coupon.session.create') }}" method="get">
                                                    @csrf
                                                    <div class="coupon-block">
                                                        <div class="coupon-text">
                                                            <label for="coupon_code">Coupon:</label>
                                                            <input type="text" name="coupon_code" class="input-text"
                                                                id="coupon_code" value="" placeholder="Coupon code">
                                                        </div>
                                                        <div class="coupon-btn">
                                                            <input type="submit" class="btn btn-outlined"
                                                                value="Apply coupon">
                                                        </div>
                                                        @if ($errors->has('coupon_code'))
                                                            @foreach ($errors->get('coupon_code') as $error)
                                                                <small class="text-danger">{{ $error }}</small>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </form>
                                                <div class="update-block text-right">
                                                    <input type="submit" class="btn btn-outlined" value="Update cart"
                                                        form="cart_form">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-section-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb--30 mb-lg--0">
                        {{-- slide Block 5 / Normal Slider --}}
                        <div class="cart-block-title">
                            <h2>YOU MAY BE INTERESTED IN…</h2>
                        </div>
                        <div class="product-slider sb-slick-slider"
                            data-slick-setting='{
                                "autoplay": true,
                                "autoplaySpeed": 8000,
                                "slidesToShow": 2
                            }'
                            data-slick-responsive='[
                                {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                                {"breakpoint":575, "settings": {"slidesToShow": 2} },
                                {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                {"breakpoint":320, "settings": {"slidesToShow": 1} }
                            ]'>
                            @if (isset($related_products))
                                @forelse ($related_products as $related_product)
                                    <div class="single-slide">
                                        <div class="product-card">
                                            <div class="product-header">
                                                <a href="#" class="author">
                                                    {{ $related_product->author }}
                                                </a>
                                                <h3>
                                                    @if ($related_product->type == 'Book')
                                                        <a
                                                            href="{{ route('botu.product.details', [$related_product->id, $related_product->slug]) }}">{{ $related_product->name }}</a>
                                                    @else
                                                        <a
                                                            href="{{ route('botu.tutorial.details', [$related_product->id, $related_product->slug]) }}">{{ $related_product->name }}</a>
                                                    @endif
                                                </h3>
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
                                                        <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                            height="275" width="275" alt="No Image">
                                                    @endif
                                                    <div class="hover-contents">
                                                        @if ($related_product->type == 'Book')
                                                            <a href="{{ route('botu.product.details', [$related_product->id, $related_product->slug]) }}"
                                                                class="hover-image">
                                                                @if (!empty($product_image[0]))
                                                                    <img src="{{ url('/uploads/product_images/' . $product_image[0]) }}"
                                                                        height="275" width="275"
                                                                        alt="Product Image">
                                                                @else
                                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                        height="275" width="275" alt="No Image">
                                                                @endif
                                                            </a>
                                                        @else
                                                            <a href="{{ route('botu.tutorial.details', [$related_product->id, $related_product->slug]) }}"
                                                                class="hover-image">
                                                                @if (!empty($product_image[0]))
                                                                    <img src="{{ url('/uploads/product_images/' . $product_image[0]) }}"
                                                                        height="275" width="275"
                                                                        alt="Product Image">
                                                                @else
                                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                        height="275" width="275" alt="No Image">
                                                                @endif
                                                            </a>
                                                        @endif
                                                        <div class="hover-btns">
                                                            <form
                                                                action="{{ route('botu.add_to_cart', $related_product->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="single-btn">
                                                                    <i class="fas fa-shopping-basket"></i>
                                                                </button>
                                                            </form>
                                                            <form
                                                                action="{{ route('botu.add_to_wishlist', $related_product->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="single-btn">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                            </form>
                                                            <button type="button" data-toggle="modal"
                                                                class="single-btn product_details_modal"
                                                                data-id="{{ $related_product->id }}"
                                                                data-name="{{ $related_product->name }}"
                                                                data-author="{{ $related_product->author }}"
                                                                data-image="{{ $related_product->image }}"
                                                                data-stock-status="{{ $related_product->stock_status }}"
                                                                data-price="{{ $related_product->price }}"
                                                                data-discount="{{ $related_product->discount }}"
                                                                data-short-description="{{ $related_product->short_description }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
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
                                        <p class="alert alert-danger" style="font-size: 1rem; text-align: center;">Sorry
                                            No
                                            Related
                                            Products found</p>
                                    </div>
                                @endforelse
                            @else
                                <div>
                                    <p class="alert alert-danger" style="font-size: 1rem; text-align: center;">Sorry
                                        No
                                        Related
                                        Products found</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Cart Summary --}}
                    @php
                        $cart_items = App\Models\Cart::all()->where('ip_address', request()->ip());
                        $total_cart_price = $cart_items->sum(function ($total) {
                            $product_price = $total->product->price - ($total->product->price * $total->product->discount) / 100;
                            return $product_price * $total->quantity;
                        });
                    @endphp
                    <div class="col-lg-6 col-12 d-flex">
                        <div class="cart-summary">
                            <div class="cart-summary-wrap">
                                <h4><span>Cart Summary</span></h4>
                                @if (session()->has('coupon'))
                                    <p>Sub Total <span
                                            class="text-primary">৳{{ $total_cart_price - ($total_cart_price * session()->get('coupon')['coupon_discount']) / 100 }}</span>
                                    </p>
                                    <p>Shipping Cost <span class="text-primary">৳{{ 50 }}</span></p>
                                    <h2>Grand Total <span
                                            class="text-primary">৳{{ $total_cart_price - ($total_cart_price * session()->get('coupon')['coupon_discount']) / 100 + 50 }}</span>
                                    </h2>
                                @else
                                    <p>Sub Total <span class="text-primary">৳{{ $total_cart_price }}</span></p>
                                    <p>Shipping Cost <span class="text-primary">৳{{ 50 }}</span></p>
                                    <h2>Grand Total <span class="text-primary">৳{{ $total_cart_price + 50 }}</span></h2>
                                @endif
                            </div>
                            <div class="cart-summary-button">
                                <a href="{{ route('botu.order.checkout.page') }}"
                                    class="checkout-btn c-btn btn--primary">Checkout</a>
                                <button type="submit" class="update-btn c-btn btn-outlined" form="cart_form">Update
                                    Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- Cart Page End --}}
    @include('frontend.fixed.product_details_modal')
@endsection
