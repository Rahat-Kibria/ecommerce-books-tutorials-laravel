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
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > View Category</h3>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    @if (!empty($category->image))
                                        <div class="swiper-slide">
                                            <img src="{{ url('/uploads/category_images/' . $category->image) }}" />
                                        </div>
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
                                    @if (!empty($category->image))
                                        <div class="swiper-slide">
                                            <img src="{{ url('/uploads/category_images/' . $category->image) }}" />
                                        </div>
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
                                    <a href="{{ route('admin.categories.list') }}"
                                        class="btn btn-info d-flex align-items-center"> <i
                                            class="fa fa-long-arrow-left"></i> <span class="ms-1">Back</span> </a>
                                </div>
                                <div class="mt-4 mb-3">
                                    <h5 class="text-uppercase">{{ $category->name }}</h5>
                                </div>
                                <div class="sizes mt-3">
                                    <h6 class="text-uppercase d-inline">Status:</h6>
                                    @if ($category->status == 'Active')
                                        <span class="text-uppercase btn btn-success rounded-pill"
                                            style="padding: 0 5px; cursor: default;">{{ $category->status }}</span>
                                    @else
                                        <span class="text-uppercase btn btn-danger rounded-pill"
                                            style="padding: 0 5px; cursor: default;">{{ $category->status }}</span>
                                    @endif
                                </div>
                                <p class="about">{{ $category->description }}</p>
                                <div class="cart mt-4 align-items-center">
                                    <a type="button" href="{{ route('admin.category.update', $category->id) }}"
                                        class="btn btn-warning text-uppercase me-2 px-4"><i
                                            class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="{{ route('admin.category.delete', $category->id) }}"
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
