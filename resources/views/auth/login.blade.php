<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/frontend/image/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="{{ url('/backend/login/css/style.css') }}" rel="stylesheet">
    <script src="{{ url('/custom/jquery-3.6.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
    <title>Admin Login</title>
</head>

<body>
    <section class="form-01-main">
        <div class="form-cover">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-sub-main">
                            <div class="_main_head_as">
                                <h4 style="color: #62ab00; font-size: 3rem; font-weight: bolder;"><i
                                        class="fa-solid fa-user-secret"></i></h4>
                                <h3 style="color: #62ab00; font-size: 3rem; font-weight: bolder;">Admin Login</h3>
                            </div>
                            <form action="{{ route('admin.login.submit') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Enter Your Username or Email" value="{{ old('username') }}"
                                        autocomplete="username" required autofocus>
                                    @if ($errors->has('username'))
                                        @foreach ($errors->get('username') as $error)
                                            <small class="text-warning">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" id="showPassword" class="form-control" name="password"
                                        placeholder="Enter Your Password" required="required">
                                    <i class="fa fa-fw fa-eye toggle-password"></i>
                                    @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $error)
                                            <small class="text-warning">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="btn_uy">
                                        <input type="submit" value="Login">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="check_box_main">
                                        <a href="{{ route('password.request') }}" class="pas-text">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="btn_uy">
                                        <a href="{{ route('botu') }}" class="btn_uy">Back to User </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // hide or show password
            $(".toggle-password").on("click", function() {
                var x = document.getElementById("showPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });

            // Toastr messages
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @elseif (Session::has('warning'))
                toastr.success("{{ Session::get('warning') }}");
            @elseif (Session::has('error'))
                toastr.success("{{ Session::get('error') }}");
            @elseif (Session::has('info'))
                toastr.success("{{ Session::get('info') }}");
            @endif
        });
    </script>
</body>

</html>
