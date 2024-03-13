<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    Hi {{ $order->id }} <br>
    @foreach ($order->orderDetails as $orderItem)
        {{ $orderItem->product->name }}
    @endforeach
    <div>
        <img src="{{ url('/frontend/image/books-tutorials-logo.png') }}" style="width: 181px; height:39px"
            alt="My Website Logo">
    </div>
</body>

</html>
