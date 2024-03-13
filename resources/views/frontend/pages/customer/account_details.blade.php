@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="account-info">
                <div class="myaccount-content">
                    <h3>Account Details</h3>
                    <div class="account-details-form">
                        <form action="{{ route('botu.account.details.update') }}" method="post">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12  mb--30">
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" name="first_name" id="first_name" class="mb-0 form-control"
                                        value="{{ auth()->user()->first_name }}" placeholder="Enter first name" required>
                                    @if ($errors->has('first_name'))
                                        @foreach ($errors->get('first_name') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-6 col-12  mb--30">
                                    <label for="last_name" class="form-label">Last Name:</label>
                                    <input type="text" name="last_name" id="last_name" class="mb-0 form-control"
                                        value="{{ auth()->user()->last_name }}" placeholder="Enter last name" required>
                                    @if ($errors->has('last_name'))
                                        @foreach ($errors->get('last_name') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="contact_number" class="form-label">Contact
                                        Number:</label>
                                    <input type="text" id="contact_number" name="contact_number"
                                        class="mb-0 form-control" value="{{ auth()->user()->contact_number }}"
                                        placeholder="Enter contact number" required>
                                    @if ($errors->has('contact_number'))
                                        @foreach ($errors->get('contact_number') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select name="gender" id="gender" class="mb-0 form-control">
                                        <option @if (auth()->user()->gender == 'Male') selected @endif value="Male">Male
                                        </option>
                                        <option @if (auth()->user()->gender == 'Female') selected @endif value="Female">Female
                                        </option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        @foreach ($errors->get('gender') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="birthday" class="form-label">Date of Birth:</label>
                                    <input type="date" name="birthday" id="birthday" class="mb-0 form-control"
                                        value="{{ auth()->user()->birthday }}">
                                    @if ($errors->has('birthday'))
                                        @foreach ($errors->get('birthday') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ auth()->user()->email }}" placeholder="Enter your email" required>
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" name="username" id="username" class="mb-0 form-control"
                                        value="{{ auth()->user()->username }}" placeholder="Enter your username" required>
                                    @if ($errors->has('username'))
                                        @foreach ($errors->get('username') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button class="btn btn--primary" type="submit">Save
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="account-details-form">
                        <form action="{{ route('botu.account.details.update.password') }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-12  mb--30">
                                    <h4>Password change</h4>
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" name="password" id="password" class="mb-0 form-control"
                                        placeholder="Type password" required>
                                    @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12  mb--30">
                                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="mb-0 form-control" placeholder="Type password again" required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn--primary" type="submit">Save
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
        <br>
        <div class="tab-content" id="myaccountContent">
            <a href="{{ route('botu.account.delete') }}" class="btn btn-danger ml--30">Delete Account</a>
        </div>
    </div>
@endsection
