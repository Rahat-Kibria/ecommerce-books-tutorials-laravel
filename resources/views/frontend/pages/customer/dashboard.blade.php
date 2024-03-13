@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <style>
        .make_invisible {
            opacity: 0;
        }

        .make_invisible:hover {
            opacity: 1;
        }
    </style>
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="dashboad">
                <div style="text-align: center">
                    <form action="{{ route('botu.account.details.update.image') }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        @if (auth()->user()->image == null)
                            <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                style="width:300px; height:300px; border-radius:50%" alt="Not Image">
                        @else
                            <img src="{{ url('/uploads/users/' . auth()->user()->image) }}"
                                style="width:300px; height:300px; border-radius:50%" class="img-thumbnail"
                                value="{{ auth()->user()->image }}" alt="Customer Image">
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <label for="upload">
                                    <i class="fa fa-file fa-3x make_invisible"></i>
                                    <input type="file" id="upload" name="image" class="form-control"
                                        value="{{ auth()->user()->image }}"
                                        accept="image/png, image/jpeg, image/jpg, image/gif" hidden>
                                </label>

                            </div>
                            <div class="col-lg-6 col-12">
                                <button class="btn btn--primary make_invisible" type="submit">Change Image</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="myaccount-content">
                    <h3>Dashboard</h3>
                    <div class="welcome mb-20">
                        <p>Hello, <strong>{{ auth()->user()->first_name }}
                                {{ auth()->user()->last_name }}</strong> ( If Not
                            <strong>{{ auth()->user()->first_name }}
                                ! </strong><a href="{{ route('botu.logout') }}" class="logout">
                                Logout</a> )
                        </p>
                    </div>
                    <p class="mb-0">From your account dashboard. you can easily check &amp; view
                        your
                        recent orders, manage your shipping and billing addresses and edit your
                        password and account details.</p>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
