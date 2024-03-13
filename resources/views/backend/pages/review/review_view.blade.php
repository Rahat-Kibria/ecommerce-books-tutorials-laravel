@extends('backend.admin')
@section('content')
    <Style>
        body {
            background-color: #fff;
        }

        .card {
            border: 1px solid #aaa;
        }

        .coupon {
            background-color: #eee;
        }

        .brand {
            font-size: 13px;
        }

        .act-price {
            color: 62ab00;
            font-weight: 700;
        }

        .dis-price {
            text-decoration: line-through;
        }

        .about {
            font-size: 14px;
        }

        .color {
            margin-bottom: 10px;
        }

        .act-price {
            color: #62ab00;
            font-weight: bolder;
        }

        label.radio {
            cursor: pointer;
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            padding: 2px 9px;
            border: 2px solid #62ab00;
            display: inline-block;
            color: #62ab00;
            border-radius: 3px;
            text-transform: uppercase
        }

        label.radio input:checked+span {
            border-color: #62ab00;
            background-color: #62ab00;
            color: #fff
        }

        .card i {
            margin-right: 10px;
        }
    </Style>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="coupon p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.reviews.list') }}"
                                        class="btn btn-info d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i>
                                        <span class="ms-1">Back</span> </a>
                                </div>
                                <div class="sizes mt-2">
                                    <h4 class="text-uppercase d-inline">Product Name:</h4>
                                    <span>{{ $review->product->name }}</span>
                                </div>
                                <div class="sizes mt-2">
                                    <h6 class="text-uppercase d-inline">User Name:</h6>
                                    <span>
                                        @if (!empty($review->user))
                                            {{ $review->user->first_name }} {{ $review->user->last_name }}
                                        @endif
                                    </span>
                                </div>
                                <div class="sizes mt-2">
                                    <h6 class="text-uppercase d-inline">User Email:</h6>
                                    <span>
                                        @if (!empty($review->user))
                                            {{ $review->user->email }}
                                        @endif
                                    </span>
                                </div>
                                <div class="sizes mt-2">
                                    <h5 class="text-uppercase d-inline">Rating:</h5>
                                    <span><span style="font-size: 1.5rem;">{{ $review->rating }}</span>/5</span>
                                </div>
                                <div class="sizes mt-2">
                                    <h5 class="text-uppercase d-inline">Comment:</h5>
                                    <div style="border: 1px solid #bbb;">{{ $review->message }}</div>
                                </div>
                                <div class="sizes my-3">
                                    <h5 class="text-uppercase d-inline">Status:</h5>
                                    @if ($review->status == 'pending')
                                        <span class="btn-sm btn-warning"
                                            style="text-transform: capitalize;">{{ $review->status }}</span>
                                    @else
                                        <span class="btn-sm btn-success"
                                            style="text-transform: capitalize;">{{ $review->status }}</span>
                                    @endif
                                </div>
                                <div class="align-items-center d-inline">
                                    <a href="{{ route('admin.review.edit', $review->id) }}"
                                        class="btn btn-warning text-uppercase me-2 px-4"><i
                                            class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="{{ route('admin.review.delete', $review->id) }}"
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
