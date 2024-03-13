<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    <style>
        body {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" style="margin: 10px;" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('warning') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('socialite.password.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container" style="width: 30%; margin-top: 10%; background-color: #fff;">
            <div class="pb-3 text-center">
                <h3>Create or Update Socialite Password</h3>
            </div>
            <div class="pb-3 text-center">
                <label for="password" class="form-label" style="font-weight:bold; font-size:1.3rem;">Password</label>
                <input type="password" class="form-control" name="password" id="password"
                    placeholder="Type Password here">
                @if ($errors->has('password'))
                    @foreach ($errors->get('password') as $error)
                        <small class="text-danger">{{ $error }}</small>
                    @endforeach
                @endif
            </div>
            <div class="pb-3 text-center">
                <label for="password_confirmation" class="form-label"
                    style="font-weight:bold; font-size:1.3rem;">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                    placeholder="Type password again">
            </div>
            <div class="pb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
