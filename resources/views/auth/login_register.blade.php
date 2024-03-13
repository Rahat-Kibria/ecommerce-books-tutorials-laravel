@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Login Registration</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    {{-- =============================================
    =            Login Register page content         =
    ============================================= --}}
    <main class="page-section inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0">
                    {{-- Registration Form --}}
                    <form action="{{ route('botu.registration') }}" method="post">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">New Customer</h4>
                            <p><span class="font-weight-bold">I am a new customer</span></p>
                            <div class="row">
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">First Name:</label>
                                    <input type="text" name="first_name" class="mb-0 form-control"
                                        placeholder="Enter your first name" required>
                                    @if ($errors->has('first_name'))
                                        @foreach ($errors->get('first_name') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Last Name:</label>
                                    <input type="text" name="last_name" class="mb-0 form-control"
                                        placeholder="Enter your last name" required>
                                    @if ($errors->has('last_name'))
                                        @foreach ($errors->get('last_name') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Contact Number:</label>
                                    <input type="text" name="contact_number" class="mb-0 form-control"
                                        placeholder="Enter your phone number" required>
                                    @if ($errors->has('contact_number'))
                                        @foreach ($errors->get('contact_number') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Gender:</label>
                                    <select name="gender" class="mb-0 form-control">
                                        <option value="Male" default>Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Date of Birth:</label>
                                    <input type="date" name="birthday" class="mb-0 form-control">
                                    @if ($errors->has('birthday'))
                                        @foreach ($errors->get('birthday') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Image:</label>
                                    <input type="file" name="image" class="mb-0 form-control"
                                        accept="image/png, image/jpeg, image/jpg, image/gif">
                                    @if ($errors->has('image'))
                                        @foreach ($errors->get('image') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                        required>
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" name="username" id="username" class="mb-0 form-control"
                                        placeholder="Enter your username" required>
                                    @if ($errors->has('username'))
                                        @foreach ($errors->get('username') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 col-12 mb--15" style="position: relative;" id="show_hide_password">
                                    <label class="form-label">Password:</label>
                                    <input type="password" name="password" class="mb-0 form-control"
                                        placeholder="Enter your password" required>
                                    @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                    <a href="javascript:" style="position: absolute; right: 25px; bottom: 8px;"><i
                                            class="fa fa-eye-slash"></i></a>
                                </div>
                                <div class="col-md-12">
                                    <button type="Submit" class="btn btn-outlined">Register</button>
                                </div>
                                <div class="col-md-12 col-12 mb--15"
                                    style="align-items: center; color: #ccc; display: flex; margin: 25px 0;">
                                    <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                                    <div style="flex-grow: 1; margin: 0 15px; text-align: center;">or</div>
                                    <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                                </div>
                                <div class="share-block col-md-12 col-12 mb--15">
                                    <h3>Register With</h3>
                                    <div class="social-links justify-content-center">
                                        <a href="{{ route('login.facebook') }}" class="single-social social-rounded"><i
                                                class="fab fa-facebook-f"></i></a>
                                        <a href="{{ route('login.google') }}" class="single-social social-rounded"><i
                                                class="fab fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Login Form --}}
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form action="{{ route('botu.login') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="login-form">
                            <h4 class="login-title">Already a Customer?</h4>
                            <p><span class="font-weight-bold">I am a returning customer</span></p>
                            <div class="row">
                                <div class="col-md-12 col-12 mb--15">
                                    <label class="form-label">Username or Email:</label>
                                    <input type="username" name="username" class="form-control"
                                        placeholder="Enter Your Username or Email" value="{{ old('username') }}"
                                        autocomplete="username" required autofocus>
                                    @if ($errors->has('username'))
                                        @foreach ($errors->get('username') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12 mb--20" style="position: relative;" id="show_hide_password">
                                    <label class="form-label">Password:</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Enter Your Password" required>
                                    @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                    <a href="" style="position: absolute; right: 25px; bottom: 8px;"><i
                                            class="fa fa-eye-slash"></i></a>
                                </div>
                                <div class="col-md-12">
                                    <button type="Submit" class="btn btn-outlined">Login</button>
                                    <a href="{{ route('password.request') }}" class="btn-sm btn-secondary">Forgot
                                        Password?</a>
                                </div>
                                <div class="col-md-12 col-12 mb--15"
                                    style="align-items: center; color: #ccc; display: flex; margin: 25px 0;">
                                    <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                                    <div style="flex-grow: 1; margin: 0 15px; text-align: center;">or</div>
                                    <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                                </div>
                                <div class="share-block col-md-12 col-12 mb--15">
                                    <h3>Login With</h3>
                                    <div class="social-links justify-content-center">
                                        <a href="{{ route('login.facebook') }}" class="single-social social-rounded"><i
                                                class="fab fa-facebook-f"></i></a>
                                        <a href="{{ route('login.google') }}" class="single-social social-rounded"><i
                                                class="fab fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
