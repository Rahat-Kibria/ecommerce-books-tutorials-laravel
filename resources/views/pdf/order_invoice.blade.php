<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .col-1 {
            width: 8.33%;
        }

        .col-2 {
            width: 16.66%;
        }

        .col-3 {
            width: 25%;
        }

        .col-4 {
            width: 33.33%;
        }

        .col-5 {
            width: 41.66%;
        }

        .col-6 {
            width: 50%;
        }

        .col-7 {
            width: 58.33%;
        }

        .col-8 {
            width: 66.66%;
        }

        .col-9 {
            width: 75%;
        }

        .col-10 {
            width: 83.33%;
        }

        .col-11 {
            width: 91.66%;
        }

        .col-12 {
            width: 100%;
        }

        [class*="col-"] {
            float: left;
            padding: 15px;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
    <div style="padding: 30px; margin: auto; border: 1px solid #ddd;">
        <div class="row">
            <div class="col-7">
                <img src="{{ public_path('/frontend/image/books-tutorials-logo.png') }}"
                    style="width: 181px; height:39px" alt="My Website Logo">
            </div>
            <div class="col-5">
                <h3>Botu Shop</h3>
                <address>
                    House Building <br>
                    Uttara, Dhaka-1230
                </address>
            </div>
        </div>
        <div style="padding: 0 0 0 20px;">
            <h2 style="text-transform: uppercase;">Invoice</h2>
        </div>
        <div class="row" style="padding-bottom: 5px;">
            <div class="col-6">
                <h4 style="background-color: #ddd; width: 90%;">Delivery Address</h4>
                <address>
                    {{ $order->user->first_name }} {{ $order->user->last_name }} <br>
                    {{ $order->user->address }}<br>
                    {{ $order->user->city }}<br>
                    {{ $order->user->country }}<br>
                    <a href="tel:01234567890">{{ $order->user->contact_number }}</a><br>
                    <a href="mailto:webmaster@example.com">{{ $order->user->email }}</a><br>
                </address>
            </div>
            <div class="col-6">
                <h4 style="background-color: #ddd; width: 90%;">Order Info</h4>
                <table style="width: 100%; text-align: left;">
                    <tr>
                        <th>Invoice Number:</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Invoice Date:</th>
                        <td>{{ Carbon\Carbon::now()->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Order Number:</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Order Date:</th>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method:</th>
                        <td>{{ $order->payment_type }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status:</th>
                        @if ($order->is_paid == 'complete')
                            <td>Paid</td>
                        @else
                            <td>Not Paid</td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table style="width: 100%; border-collapse: collapse; border-spacing: 10px;">
                    <tr style="background-color: #000; color: #fff">
                        <th style="border: 1px solid #ddd; text-align: left;">Product
                        </th>
                        <th style="border: 1px solid #ddd; text-align: left;">Quantity</th>
                        <th style="border: 1px solid #ddd; text-align: left;">Price</th>
                    </tr>
                    @foreach ($order->orderDetails as $orderItem)
                        <tr>
                            <td style="border: 1px solid #ddd;">{{ $orderItem->product->name }}
                            </td>
                            <td style="border: 1px solid #ddd;">{{ $orderItem->product_quantity }}
                            </td>
                            <td style="border: 1px solid #ddd;">
                                {{ $orderItem->product->price - ($orderItem->product->price * $orderItem->product->discount) / 100 }}
                                TK
                            </td>
                        </tr>
                    @endforeach
                    <tr style="border-top: 7px solid #ddd">
                        <th></th>
                        <th style="border: 1px solid #ddd; text-align: left;">Subtotal: </th>
                        <td style="border: 1px solid #ddd;">{{ $order->total }} TK</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="border: 1px solid #ddd; text-align: left;">Coupon Applied: </th>
                        @if ($order->coupon_id == null)
                            <td style="border: 1px solid #ddd;">No</td>
                        @else
                            <td style="border: 1px solid #ddd;">Yes</td>
                        @endif
                    </tr>
                    <tr>
                        <th></th>
                        <th style="border-left: 1px solid #ddd; border-right: 1px solid #ddd; text-align: left;">
                            Shipping: </th>
                        <td style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">{{ 50.0 }} TK
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="border: 1px solid #000; text-align: left;">Total: </th>
                        <td style="border: 1px solid #000;">{{ $order->grand_total }} TK</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="border: 1px solid #000; text-align: left;">Customer Payable: </th>
                        @if ($order->is_paid == 'complete')
                            <td style="border: 1px solid #000;">0 TK</td>
                        @else
                            <td style="border: 1px solid #000;">{{ $order->grand_total }} TK</td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
