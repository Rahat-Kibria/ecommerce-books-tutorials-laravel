<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auth User Creation</title>
</head>

<body style="background-color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif;">
    <div style="width: 60%; margin: auto; border: 1px solid #ddd;">
        <div style="background-color: #62ab00; padding: 30px;">
            <h1>Login With these credentials to our shop</h1>
        </div>
        <div style="padding: 30px;">
            <p>Hi {{ $user->first_name }},</p>
            <p>Now you can login to our shop and download our audios and ebooks. You can change your credentials in your account.</p>
            <p>Happy Shopping.</p>

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="border: 1px solid #ddd; text-align: left;">Email Address</th>
                    <td style="border: 1px solid #ddd; text-align: left;">{{ $user->email }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; text-align: left;">Username</th>
                    <td style="border: 1px solid #ddd; text-align: left;">{{ $username }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; text-align: left;">Password</th>
                    <td style="border: 1px solid #ddd; text-align: left;">{{ $password }}</td>
                </tr>
            </table>

            <p style="padding-top: 20px;">Thanks for using <a href="route('botu')">botu.com</a></p>
        </div>
    </div>
    <p style="text-align:center; padding: 20px">Botu Shop Bangladesh -- Built with <a
            href="https://laravel.com/">Laravel</a></p>
</body>

</html>
