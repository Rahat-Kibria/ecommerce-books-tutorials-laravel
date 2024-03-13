@extends('backend.admin')
@section('content')
    <div class="row" style="padding: 0 10px 0 10px;">
        <div class="col-7 mt-3">
            <h4 class="alert alert-success" style="width: 40%;">Order Number <span
                    class="text-danger">#{{ $order->id }}</span></h4>
        </div>
        <div class="col-5" style="padding-top: 30px; text-align:right;">
            <a href="{{ route('admin.order.invoice.view', $order->id) }}" class="btn btn-success">View Invoice</a>
            <a href="{{ route('admin.order.invoice.generate', $order->id) }}" class="btn btn-success">Generate Invoice</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div style="padding: 10px;">
                <table class="table table-hover table-success text-center">
                    <thead>
                        <tr>
                            <th colspan='2' style="font-size: 1.5rem; text-transform: uppercase;">Products Summery</th>
                            <th scope="col" style="text-transform: uppercase;">Quantity</th>
                            <th scope="col" style="text-transform: uppercase;">Price</th>
                            <th scope="col" style="text-transform: uppercase;">Total Price</th>
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
                                <td>{{ $order_detail->product->name }}</td>
                                <td>{{ $order_detail->product_quantity }}</td>
                                <td>৳{{ $product_price }}</td>
                                <td>৳{{ $order_detail->product_quantity * $product_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding: 10px;">
                <table class="table table-hover table-success">
                    <thead>
                        <tr>
                            <th colspan='2' style="font-size: 1.5rem; text-transform: uppercase;">Customer Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td style="text-align: right;">{{ $order->user->first_name }} {{ $order->user->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td style="text-align: right;">{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td style="text-align: right;">{{ $order->user->contact_number }}</td>
                        </tr>
                        <tr>
                            <th>Customer Address</th>
                            <td style="text-align: right;">{{ $order->user->address }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td style="text-align: right;">{{ $order->user->city }}</td>
                        </tr>
                        <tr>
                            <th>Post Code</th>
                            <td style="text-align: right;">{{ $order->user->postal_code }}</td>
                        </tr>
                        <tr>
                            <th>Ccountry</th>
                            <td style="text-align: right;">{{ $order->user->country }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-5">
            <div style="padding:10px;">
                <table class="table table-hover table-success">
                    <thead>
                        <tr>
                            <th colspan='2' style="font-size: 1.5rem; text-transform: uppercase;">Order Summery
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Order Created</th>
                            <td style="text-align: right;">{{ $order->created_at->format('m/d/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Order Time</th>
                            <td style="text-align: right;">{{ $order->created_at->format('H:i:s A') }}</td>
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
            <div style="padding:10px;">
                <table class="table table-hover table-success">
                    <tbody>
                        <tr>
                            <th>Order Message</th>
                        </tr>
                        <tr>
                            <td>{{ $order->message }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
