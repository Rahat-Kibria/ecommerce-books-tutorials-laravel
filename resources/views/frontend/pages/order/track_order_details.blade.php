@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Track Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- order track Page Start --}}
    <div class="page-section inner-page-sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12 col-12 mt--30 mt-lg--0">
                            <div class="tab-content" id="myaccountContent">
                                {{-- Single Tab Content Start --}}
                                <div id="orders">
                                    <div class="myaccount-content">
                                        <h3>Order Number: {{ $order->id }}</h3>
                                        @inject('carbon', 'Carbon\Carbon')
                                        @php
                                            $completion_date = new DateTime($order->completion_date);
                                            $converted_completion_date = date_add($completion_date, date_interval_create_from_date_string('7 days'));
                                        @endphp
                                        @if ($order->is_cancelled == 'no')
                                            @if ($converted_completion_date > $carbon::now())
                                                <form action="{{ route('botu.order.cancel', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-secondary d-flex">Cancel
                                                        Order</button>
                                                </form>
                                            @else
                                                <a href="javascript:" class="btn-sm btn-danger">Order Cancellation time
                                                    expired</a>
                                            @endif
                                        @elseif ($order->is_cancelled == 'yes')
                                            <a href="javascript:" class="btn btn-danger">Order is Cancelled</a>
                                        @endif
                                        <div style="border: 1px solid #1e1e1e; margin-bottom:20px; margin-top:20px;">
                                            <h5 style="margin:10px;">Status:
                                                @if ($order->is_cancelled == 'yes')
                                                    Order is cancelled
                                                @elseif ($order->is_completed == 'yes')
                                                    Order is completed
                                                @elseif ($order->is_out_for_delivery == 'yes')
                                                    Order is out for delivery
                                                @elseif ($order->is_seen_by_admin == 'yes')
                                                    Order is processing
                                                @else
                                                    Order is confirmed
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="track">
                                            <div class="step @if ($order->is_cancelled == 'no') active @endif"> <span
                                                    class="icon"> <i class="fa fa-check"></i>
                                                </span> <span class="text">Order confirmed</span> </div>
                                            <div class="step @if ($order->is_seen_by_admin == 'yes') active @endif"> <span
                                                    class="icon"> <i class="fa fa-user"></i>
                                                </span> <span class="text"> Processing</span> </div>
                                            <div class="step @if ($order->is_out_for_delivery == 'yes') active @endif"> <span
                                                    class="icon"> <i class="fa fa-truck"></i> </span>
                                                <span class="text"> On the way </span>
                                            </div>
                                            <div class="step @if ($order->is_completed == 'yes') active @endif"> <span
                                                    class="icon"> <i class="fa fa-box"></i> </span>
                                                <span class="text">Order Completed</span>
                                            </div>
                                        </div>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th colspan='2'
                                                            style="font-size: 1.5rem; text-transform: uppercase;">Products
                                                            Summery
                                                        </th>
                                                        <th scope="col" style="text-transform: uppercase;">Quantity</th>
                                                        <th scope="col" style="text-transform: uppercase;">Price</th>
                                                        <th scope="col" style="text-transform: uppercase;">Total Price
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_details as $order_detail)
                                                        <tr>
                                                            @php
                                                                $image = json_decode($order_detail->product->image);
                                                                $product_price = $order_detail->product->price - ($order_detail->product->price * $order_detail->product->discount) / 100;
                                                            @endphp
                                                            <td>
                                                                <img src="{{ url('/uploads/product_images/' . $image[0]) }}"
                                                                    style="height:60px; width:50px;" alt="Product Image">
                                                            </td>
                                                            <td>
                                                                @if ($order_detail->product->type == 'Book')
                                                                    <a
                                                                        href="{{ route('botu.product.details', [$order_detail->product->id, $order_detail->product->slug]) }}">{{ $order_detail->product->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('botu.tutorial.details', [$order_detail->product->id, $order_detail->product->slug]) }}">{{ $order_detail->product->name }}</a>
                                                                @endif
                                                            </td>
                                                            <td>{{ $order_detail->product_quantity }}</td>
                                                            <td>৳{{ $product_price }}</td>
                                                            <td>৳{{ $order_detail->product_quantity * $product_price }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class=" table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan='2'
                                                            style="font-size: 1.5rem; text-transform: uppercase; background-color:#14191E; color:#fff; text-align: center;">
                                                            Order Summery
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Order Created</th>
                                                        <td style="text-align: right;">
                                                            {{ $order->created_at->format('m/d/Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Time</th>
                                                        <td style="text-align: right;">
                                                            {{ $order->created_at->format('H:i:s A') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Coupon Code</th>
                                                        <td style="text-align: right;">
                                                            @if ($order->coupon != null)
                                                                {{ $order->coupon->code }}
                                                            @else
                                                                <span>-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Coupon Discount</th>
                                                        <td style="text-align: right;">
                                                            @if ($order->coupon != null)
                                                                {{ $order->coupon_discount }}%
                                                            @else
                                                                <span>0%</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sub Total</th>
                                                        <td style="text-align: right;">৳{{ $order->total }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Delivery Fee</th>
                                                        <td style="text-align: right;">৳{{ 50 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Grand Total</th>
                                                        <td style="text-align: right;">৳{{ $order->grand_total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($order->is_completed == 'yes')
                                            <div class=" table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                style="font-size: 1.5rem; text-transform: uppercase; background-color:#14191E; color:#fff; text-align: center;">
                                                                Audio/Ebook
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <a role="button" style="cursor: pointer;" data-toggle="modal"
                                                                    data-target="#loginModal"> <strong> Login with your
                                                                        credentials provided in your SMS</strong> </a> to view
                                                                audio or ebook files in your account
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- Single Tab Content End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- order track Page Start --}}
@endsection()
