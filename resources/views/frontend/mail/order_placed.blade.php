<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Placed</title>
</head>

<body style="background-color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif;">
    <div style="width: 60%; margin: auto; border: 1px solid #ddd;">
        <div style="padding: 30px; width: 35%; margin: auto;">
            <img src="{{ url('/frontend/image/books-tutorials-logo.png') }}" style="width: 181px; height:39px"
                alt="My Website Logo">
        </div>
        <div>
            <div style="background-color: #62ab00; padding: 30px;">
                <h1>Thank you for your order</h1>
            </div>
            <div style="padding: 30px;">
                <p>Hi {{ $order->user->first_name }},</p>

                <p>Just to let you know — we've received your order #{{ $order->id }}, and it is now being processed:
                </p>
                @if ($order->payment_type == 'cash on delivery')
                    <p>Pay with cash upon delivery.</p>
                @else
                    <p>We received your payment successfully.</p>
                @endif

                <h4 style="color: #62ab00;">[Order #{{ $order->id }}] ({{ $order->created_at->format('M d,Y') }})
                </h4>

                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th colspan="2" style="border: 1px solid #ddd; text-align: left;">Product</th>
                        <th style="border: 1px solid #ddd; text-align: left;">Quantity</th>
                        <th colspan="2" style="border: 1px solid #ddd; text-align: left;">Price</th>
                    </tr>
                    @foreach ($order->orderDetails as $orderItem)
                        <tr>
                            <td colspan="2" style="border: 1px solid #ddd;">{{ $orderItem->product->name }} </td>
                            <td style="border: 1px solid #ddd;">{{ $orderItem->product_quantity }}</td>
                            <td colspan="2" style="border: 1px solid #ddd;">৳
                                {{ $orderItem->product->price - ($orderItem->product->price * $orderItem->product->discount) / 100 }}
                            </td>
                        </tr>
                    @endforeach
                    <tr style="border-top: 7px solid #ddd">
                        <th colspan="3" style="border: 1px solid #ddd; text-align: left;">Subtotal: </th>
                        <td colspan="2" style="border: 1px solid #ddd;">৳ {{ $order->total }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="border: 1px solid #ddd; text-align: left;">Coupon Applied: </th>
                        @if ($order->coupon_id == null)
                            <td colspan="2" style="border: 1px solid #ddd;">No</td>
                        @else
                            <td colspan="2" style="border: 1px solid #ddd;">Yes</td>
                        @endif
                    </tr>
                    <tr>
                        <th colspan="3" style="border: 1px solid #ddd; text-align: left;">Shipping: </th>
                        <td colspan="2" style="border: 1px solid #ddd;">৳ {{ 50.0 }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="border: 1px solid #ddd; text-align: left;">Payment Method: </th>
                        <td colspan="2" style="border: 1px solid #ddd;">{{ $order->payment_type }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="border: 1px solid #ddd; text-align: left;">Total: </th>
                        <td colspan="2" style="border: 1px solid #ddd;">৳ {{ $order->grand_total }}</td>
                    </tr>
                </table>

                <h4 style="color: #62ab00;">Shipping Address</h4>
                <address>
                    {{ $order->user->first_name }} {{ $order->user->last_name }} <br>
                    {{ $order->user->address }}<br>
                    {{ $order->user->city }}<br>
                    {{ $order->user->country }}<br>
                    <a href="tel:01234567890">{{ $order->user->contact_number }}</a><br>
                    <a href="mailto:webmaster@example.com">{{ $order->user->email }}</a><br>
                </address>

                <p style="padding-top: 20px;">Thanks for using <a href="route('botu')">botu.com</a></p>
            </div>
        </div>
    </div>
    <p style="text-align:center; padding: 20px">Botu Shop Bangladesh -- Built with <a
            href="https://laravel.com/">Laravel</a></p>
</body>

</html>
