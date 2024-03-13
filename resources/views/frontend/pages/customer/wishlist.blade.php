@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    {{-- Wishlist Page Start --}}
    <div class="cart_area inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- Cart Table --}}
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Discount</th>
                                    <th class="pro-price">New Price</th>
                                    <th class="pro-subtotal">Add To Cart</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlist_products as $wishlist_product)
                                    <tr>
                                        @php
                                            $images = json_decode($wishlist_product->product->image);
                                        @endphp
                                        <td class="pro-thumbnail">
                                            @if ($wishlist_product->product->type == 'Book')
                                                <a
                                                    href="{{ route('botu.product.details', [$wishlist_product->product->id, $wishlist_product->product->slug]) }}">
                                                    <img src="{{ url('/uploads/product_images/' . $images[0]) }}"
                                                        alt="Product">
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('botu.tutorial.details', [$wishlist_product->product->id, $wishlist_product->product->slug]) }}">
                                                    <img src="{{ url('/uploads/product_images/' . $images[0]) }}"
                                                        alt="Product">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="pro-title">
                                            @if ($wishlist_product->product->type == 'Book')
                                                <a
                                                    href="{{ route('botu.product.details', [$wishlist_product->product->id, $wishlist_product->product->slug]) }}">{{ $wishlist_product->product->name }}</a>
                                            @else
                                                <a
                                                    href="{{ route('botu.tutorial.details', [$wishlist_product->product->id, $wishlist_product->product->slug]) }}">{{ $wishlist_product->product->name }}</a>
                                            @endif
                                        </td>
                                        <td class="pro-price"><span>${{ $wishlist_product->product->price }}</span>
                                        </td>
                                        <td class="pro-quantity">
                                            <span>{{ $wishlist_product->product->discount }}%</span>
                                        </td>
                                        <td class="pro-price">
                                            <span>${{ $wishlist_product->product->price - ($wishlist_product->product->price * $wishlist_product->product->discount) / 100 }}</span>
                                        </td>
                                        <td class="pro-subtotal">
                                            {!! Form::open(['method' => 'POST', 'route' => ['botu.add_to_cart', $wishlist_product->product_id]]) !!}
                                            {{-- {!! Form::submit('add to cart') !!} --}}
                                            <button type="submit"><i class="fa fa-cart-plus"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                        <td class="pro-remove">
                                            <a href="{{ route('botu.wishlist.delete', $wishlist_product->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Wishlist Page End --}}
@endsection
