@extends('backend.admin')
@section('content')
    <style>
        .make_invisible {
            opacity: 0;
        }

        .make_invisible:hover {
            opacity: 1;
        }
    </style>
    <div class="mt-3 ps-4" style="width: 40%;">
        <h3 class="alert alert-success">Admin > Account Details</h3>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if (auth()->user()->image == null)
                        <img src="{{ url('/uploads/default/no_image.jpg') }}" class="rounded-circle mt-5" width="150px"
                            alt="No Image">
                        <form action="{{ route('admin.image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div>
                                <label for="upload">
                                    <i class="fa-solid fa-file"></i>
                                    <input type="file" name="image" id="upload" value="{{ auth()->user()->image }}"
                                        hidden>
                                    @if ($errors->has('image'))
                                        @foreach ($errors->get('image') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </label>
                            </div>
                            <input type="submit" class="btn btn-primary profile-button" value="Add Image">
                        </form>
                    @else
                        <img class="rounded-circle mt-5" width="150px"
                            src="{{ url('/uploads/users/' . auth()->user()->image) }}">
                        <form action="{{ route('admin.image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div>
                                <label for="upload">
                                    <i class="fa-solid fa-file make_invisible"></i>
                                    <input type="file" name="image" id="upload" value="{{ auth()->user()->image }}"
                                        hidden>
                                </label>
                                <input type="submit" class="btn btn-primary profile-button make_invisible"
                                    value="Update Image">
                                @if ($errors->has('image'))
                                    @foreach ($errors->get('image') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                            </div>
                        </form>
                    @endif
                    <form action="{{ route('admin.username_email.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <div>
                            <input class="font-weight-bold" name="username" value="{{ auth()->user()->username }}"
                                style="outline:none; border: none; text-align: center;">
                            @if ($errors->has('username'))
                                @foreach ($errors->get('username') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                            <input class="text-black-50 ml-5" name="email" value="{{ auth()->user()->email }}"
                                style="outline:none; border: none; text-align: center;">
                            @if ($errors->has('email'))
                                @foreach ($errors->get('email') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary profile-button make_invisible"
                                value="Update Username/Email">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right h3">Profile Details</h3>
                    </div>
                    <form action="{{ route('admin.details.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="first_name" class="labels">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    value="{{ auth()->user()->first_name }}">
                                @if ($errors->has('first_name'))
                                    @foreach ($errors->get('first_name') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="labels">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    value="{{ auth()->user()->last_name }}">
                                @if ($errors->has('last_name'))
                                    @foreach ($errors->get('last_name') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="contact_number" class="labels">Mobile Number</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control"
                                    value="{{ auth()->user()->contact_number }}">
                                @if ($errors->has('contact_number'))
                                    @foreach ($errors->get('contact_number') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="gender" class="labels">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option @if (auth()->user()->gender == 'Male') selected @endif value="Male">Male</option>
                                    <option @if (auth()->user()->gender == 'Female') selected @endif value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="birthday" class="labels">Birthday</label>
                                <input type="date" name="birthday" id="birthday" class="form-control"
                                    value="{{ auth()->user()->birthday }}">
                                @if ($errors->has('birthday'))
                                    @foreach ($errors->get('birthday') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <input class="btn btn-primary profile-button" type="submit" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5 mt-5">
                    <div class="col-md-12">
                        <label class="labels">Experience in Developing</label>
                        <input type="text" class="form-control" placeholder="experience"
                            value="PHP Laravel Developer" disabled>
                    </div>
                    <h3 class="mt-5">Change Password</h3>
                    <div class="col-md-12">
                        <form action="{{ route('admin.password.change') }}" method="post">
                            @csrf
                            @method('put')
                            <div>
                                <label for="password" class="labels">Input New Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Type the new password here" required>
                                @if ($errors->has('password'))
                                    @foreach ($errors->get('password') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-2">
                                <label for="password_confirmation" class="labels">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Type the new password again" required>
                            </div>
                            <div class="mt-2">
                                <input class="btn btn-primary profile-button" type="submit" value="Change Password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
