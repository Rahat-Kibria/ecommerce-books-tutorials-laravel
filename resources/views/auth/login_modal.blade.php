<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="{{ route('botu.login.registration.page') }}" title="Go to login page">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Customer Login</h5>
                </a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('botu.login') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group mb-3">
                        <label for="username_email" class="form-label">Username or Email:</label>
                        <input type="username" name="username" class="form-control"
                            placeholder="Enter Your Username or Email" value="{{ old('username') }}" required autofocus>
                        @if ($errors->has('username'))
                            @foreach ($errors->get('username') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3" style="position: relative;" id="show_hide_password">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Your Password"
                            required>
                        @if ($errors->has('password'))
                            @foreach ($errors->get('password') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                        <a href="javascript:" style="position: absolute; right: 8px; bottom: 13px;"><i
                                class="fa fa-eye-slash"></i></a>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('password.request') }}" class="btn-sm btn-secondary">Forgot Password?</a>
                        <button type="Submit" class="btn btn-outlined">Login</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <div style="align-items: center; color: #ccc; display: flex; margin: 25px 0;">
                        <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                        <div style="flex-grow: 1; margin: 0 15px; text-align: center;">or</div>
                        <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                    </div>
                    <div class="modal-header justify-content-center">
                        <div class="share-block">
                            <h3>Login With</h3>
                            <div class="social-links justify-content-center">
                                <a href="{{ route('login.facebook') }}" class="single-social social-rounded"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="{{ route('login.google') }}" class="single-social social-rounded"><i
                                        class="fab fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                    <p class="text-inverse text-center">Don't have an account? <a href="#"
                            class="font-weight-bold" data-toggle="modal" data-target="#registrationModal">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
