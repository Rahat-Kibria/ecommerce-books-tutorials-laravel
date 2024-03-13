<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Request</title>
    <script src="{{ url('/custom/jquery-3.6.3.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    <style>
        body {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <form action="{{ route('password.email.sent') }}" method="POST">
        @csrf
        <div class="container" style="width: 30%; margin-top: 10%; background-color: #fff;">
            <div class="pb-3 text-center">
                <h3>Forgot your password?</h3>
                <p>Please enter your email to request password reset</p>
            </div>
            <div class="pb-3 text-center">
                <label for="email" class="form-label" style="font-weight:bold; font-size:1.3rem;">Email
                    address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Type Email here">
                @if ($errors->has('email'))
                    @foreach ($errors->get('email') as $error)
                        <small class="text-danger">{{ $error }}</small>
                    @endforeach
                @endif
            </div>
            <div class="pb-3 text-center">
                <button type="submit" class="btn btn-primary">Request Password Reset</button>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toastr messages
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @elseif (Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
            @elseif (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @elseif (Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
        });
    </script>
</body>

</html>
