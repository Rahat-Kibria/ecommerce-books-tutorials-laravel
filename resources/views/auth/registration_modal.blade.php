<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="{{ route('botu.login.registration.page') }}" title="Go to registration page">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Customer Registration</h5>
                </a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('botu.registration') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter your first name"
                            required>
                        @if ($errors->has('first_name'))
                            @foreach ($errors->get('first_name') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter your last name"
                            required>
                        @if ($errors->has('last_name'))
                            @foreach ($errors->get('last_name') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Contact Number:</label>
                        <input type="text" name="contact_number" class="form-control"
                            placeholder="Enter your phone number" required>
                        @if ($errors->has('contact_number'))
                            @foreach ($errors->get('contact_number') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Gender:</label>
                        <select name="gender" class="mb-0 form-control">
                            <option value="Male" default>Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth:</label>
                        <input type="date" name="birthday" class="mb-0 form-control">
                        @if ($errors->has('birthday'))
                            @foreach ($errors->get('birthday') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Image:</label>
                        <input type="file" name="image" class="form-control"
                            accept="image/png, image/jpeg, image/jpg, image/gif">
                        @if ($errors->has('image'))
                            @foreach ($errors->get('image') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            required>
                        @if ($errors->has('email'))
                            @foreach ($errors->get('email') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter your username"
                            required>
                        @if ($errors->has('username'))
                            @foreach ($errors->get('username') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group mb-3" style="position: relative;" id="show_hide_password">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password"
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
                        <button type="Submit" class="btn btn-outlined">Register</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <div style="align-items: center; color: #ccc; display: flex; margin: 25px 0;">
                        <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                        <div style="flex-grow: 1; margin: 0 15px; text-align: center;">or</div>
                        <div style="background-color: #ccc; flex-grow: 5; height: 1px;"></div>
                    </div>
                    <div class="modal-header justify-content-center">
                        <div class="share-block">
                            <h3>Register With</h3>
                            <div class="social-links justify-content-center">
                                <a href="{{ route('login.facebook') }}" class="single-social social-rounded"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="{{ route('login.google') }}" class="single-social social-rounded"><i
                                        class="fab fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                    <p class="text-inverse text-center">Already have an account? <a href="#"
                            class="font-weight-bold" data-toggle="modal" data-target="#loginModal">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
