@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="address-edit">
                @if ($customer_address == null)
                    <div class="myaccount-content">
                        <a href="#collapseAddAddress" class="btn btn--primary" data-toggle="collapse" aria-expanded="false"
                            aria-controls="collapseAddAddress"><i class="fa fa-edit"></i>Add
                            Billing
                            Address</a>
                    </div>
                    <div class="myaccount-content collapse" id="collapseAddAddress">
                        <h3>Add Billing Address</h3>
                        <form action="{{ route('botu.account.my_address.create') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--20">
                                    <label for="address">Address*</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Address line" required>
                                    @if ($errors->has('address'))
                                        @foreach ($errors->get('address') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 mb--20">
                                    <label for="city">Town/City*</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="Town/City" required>
                                    @if ($errors->has('city'))
                                        @foreach ($errors->get('city') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 mb--20">
                                    <label for="postal_code">Postal Code*</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                                        placeholder="Postal Code" required>
                                    @if ($errors->has('postal_code'))
                                        @foreach ($errors->get('postal_code') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12 col-12 mb--20">
                                    <label for="country">Country*</label>
                                    <input type="text" name="country" id="country" class="form-control"
                                        placeholder="Country" required>
                                    @if ($errors->has('country'))
                                        @foreach ($errors->get('country') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary"><i class="fa fa-edit"></i>Add
                                Address</button>
                        </form>
                    </div>
                @else
                    <div class="myaccount-content">
                        <h3>Billing Address</h3>
                        <address>
                            <p><strong>{{ $customer_address->first_name }}
                                    {{ $customer_address->last_name }}</strong></p>
                            <p>{{ $customer_address->address }} <br>
                                {{ $customer_address->city }}
                                <br> {{ $customer_address->postal_code }}
                                <br> {{ $customer_address->country }}
                            </p>
                            <p>Mobile: {{ $customer_address->contact_number }}</p>
                        </address>
                        <a href="#collapseAddressUpdate" class="btn btn--primary" data-toggle="collapse"
                            aria-expanded="false" aria-controls="collapseAddressUpdate"><i class="fa fa-edit"></i>Edit
                            Address</a>
                    </div>
                    <div class="myaccount-content collapse" id="collapseAddressUpdate">
                        <h3>Update Billing Address</h3>
                        <form action="{{ route('botu.account.my_address.update') }}" method="post">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--20">
                                    <label for="address">Address*</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{ $customer_address->address }}" placeholder="Address line" required>
                                    @if ($errors->has('address'))
                                        @foreach ($errors->get('address') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 mb--20">
                                    <label for="city">Town/City*</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        value="{{ $customer_address->city }}" placeholder="Town/City" required>
                                    @if ($errors->has('city'))
                                        @foreach ($errors->get('city') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 mb--20">
                                    <label for="postal_code">Postal Code*</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                                        value="{{ $customer_address->postal_code }}" placeholder="Postal Code" required>
                                    @if ($errors->has('postal_code'))
                                        @foreach ($errors->get('postal_code') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12 col-12 mb--20">
                                    <label for="country">Country*</label>
                                    <input type="text" name="country" id="country" class="form-control"
                                        value="{{ $customer_address->country }}" placeholder="Country" required>
                                    @if ($errors->has('country'))
                                        @foreach ($errors->get('country') as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary"><i class="fa fa-edit"></i>Update
                                Address</button>
                        </form>
                    </div>
                @endif
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
