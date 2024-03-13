@extends('backend.admin')
@section('content')
    <Style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }
    </Style>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="swiper mySwiper2">
                                @php
                                    $productImage = json_decode($product->image);
                                @endphp
                                <div class="swiper-wrapper">
                                    @if (!empty($productImage))
                                        @for ($i = 0; $i <= 6; $i++)
                                            <div class="swiper-slide">
                                                @if (!empty($productImage[$i]))
                                                    <img src="{{ url('/uploads/product_images/' . $productImage[$i]) }}" />
                                                @endif
                                            </div>
                                        @endfor
                                    @else
                                        <div class="swiper-slide">
                                            <img src="{{ url('/uploads/default/no_image.jpg') }}" />
                                        </div>
                                    @endif
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @if (!empty($productImage))
                                        @for ($i = 0; $i <= 6; $i++)
                                            <div class="swiper-slide">
                                                @if (!empty($productImage[$i]))
                                                    <img src="{{ url('/uploads/product_images/' . $productImage[$i]) }}" />
                                                @endif
                                            </div>
                                        @endfor
                                    @else
                                        <div class="swiper-slide">
                                            <img src="{{ url('/uploads/default/no_image.jpg') }}" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4" style="height: 100%; background-color: #eee;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.products.list') }}"
                                        class="btn btn-info d-flex align-items-center"> <i
                                            class="fa fa-long-arrow-left"></i> <span class="ms-1">Back</span> </a>
                                </div>
                                <div class="mt-4 mb-3"> Author: <span
                                        class="text-uppercase text-muted brand">{{ $product->author }}</span>
                                    <h5 class="text-uppercase">{{ $product->name }}</h5>
                                    <p><b>Admin Purchased for: </b> <span>৳{{ $product->purchase_price }}</span></p>
                                    <div class="price d-flex flex-row align-items-center">
                                        <span
                                            class="act-price">৳{{ $product->price - ($product->price * $product->discount) / 100 }}</span>
                                        <div class="ms-2">
                                            <small class="dis-price"
                                                style="text-decoration: line-through;">৳{{ $product->price }}</small>
                                            <span>{{ $product->discount }}% OFF</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="about">{!! $product->short_description !!}</p>
                                <div class="sizes mt-2">
                                    <h6 class="text-uppercase d-inline">Quantity:</h6>
                                    <span class="text-uppercase">{{ $product->quantity }}</span>
                                </div>
                                <div class="sizes mt-3">
                                    <h6 class="text-uppercase d-inline">Stock Status:</h6>
                                    @if ($product->stock_status == 'Available')
                                        <span class="text-uppercase btn btn-success rounded-pill"
                                            style="padding: 0 5px; cursor: default;">{{ $product->stock_status }}</span>
                                    @else
                                        <span class="text-uppercase btn btn-danger rounded-pill"
                                            style="padding: 0 5px; cursor: default;">{{ $product->stock_status }}</span>
                                    @endif
                                </div>
                                <div class="cart mt-4 align-items-center">
                                    <a type="button" href="{{ route('admin.product.edit', $product->id) }}"
                                        class="btn btn-warning text-uppercase me-2 px-4"><i
                                            class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="{{ route('admin.product.delete', $product->id) }}"
                                        class="btn btn-danger text-uppercase me-2 px-4"
                                        onclick="return confirm('Are your sure?')"><i
                                            class="fa-solid fa-trash-can text-dark"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
