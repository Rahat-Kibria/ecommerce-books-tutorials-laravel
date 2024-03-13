<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order is not seen by Admin</title>
</head>

<body style="background-color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif;">
    <div style="width: 60%; margin: auto; border: 1px solid #ddd;">
        <div style="background-color: #62ab00; padding: 30px;">
            <h1>Your order #{{ $order->id }} is not being processed</h1>
        </div>
        <div style="padding: 30px;">
            <p>Hi {{ $user->first_name }},</p>
            <p>Your order no # {{ $order->id }} is not being processed. Call our customer support for more info.</p>
            <p>Happy Shopping.</p>

            <p style="padding-top: 20px;">Thanks for using <a href="route('botu')">botu.com</a></p>
        </div>
    </div>
    <p style="text-align:center; padding: 20px">Botu Shop Bangladesh -- Built with <a
            href="https://laravel.com/">Laravel</a></p>
</body>

</html>
