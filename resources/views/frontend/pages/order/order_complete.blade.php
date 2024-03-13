@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Complete</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- order complete Page Start --}}
    <section class="order-complete inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="order-complete-message text-center">
                        <h1>Thank you !</h1>
                        <p>Your order has been received.</p>
                    </div>
                    <ul class="order-details-list">
                        <li>Order Number: <strong>{{ $order->id }}</strong></li>
                        <li>Date: <strong>{{ $order->created_at->format('M d, Y') }}</strong></li>
                        <li>Total: <strong>৳{{ $order->grand_total }}</strong></li>
                        <li>Payment Method: <strong>{{ $order->payment_type }}</strong></li>
                    </ul>
                    @if ($order->payment_type == 'cash on delivery')
                        <p class="alert alert-warning">Pay with cash upon delivery.</p>
                    @else
                        <p class="alert alert-success">We received your payment successfully. Thank you for trusting us.</p>
                    @endif
                    <h3 class="order-table-title">Order Details</h3>
                    <div class="table-responsive">
                        <table class="table order-details-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $order_detail)
                                    <tr>
                                        <td>
                                            @if ($order_detail->product->type = 'Book')
                                                <a
                                                    href="{{ route('botu.product.details', [$order_detail->product->id, $order_detail->product->slug]) }}">{{ $order_detail->product->name }}</a>
                                            @else
                                                <a
                                                    href="{{ route('botu.tutorial.details', [$order_detail->product->id, $order_detail->product->slug]) }}">{{ $order_detail->product->name }}</a>
                                            @endif
                                            <strong>× {{ $order_detail->product_quantity }}</strong>
                                        </td>
                                        <td><span>৳{{ $order_detail->product->price * $order_detail->product_quantity }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ $order->payment_type }}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Fee:</th>
                                    <td>৳{{ 50 }}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td><span>৳{{ $order->grand_total }}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- order complete Page End --}}
@endsection()
