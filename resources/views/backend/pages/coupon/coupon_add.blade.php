@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin >Add a Coupon</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <form action="{{ route('admin.coupon.add.submit') }}" method="POST">
            @csrf
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                <legend class="w-auto">Coupon Form</legend>
                <div class="form-group mb-3">
                    <label for="code" class="form-label">Code:</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Enter coupon code"
                        required>
                    @if ($errors->has('code'))
                        @foreach ($errors->get('code') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug"
                        required>
                    @if ($errors->has('slug'))
                        @foreach ($errors->get('slug') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="expiry_date" class="form-label">Expiry Date:</label>
                    <input type="datetime-local" name="expiry_date" id="expiry_date" class="form-control" required>
                    @if ($errors->has('expiry_date'))
                        @foreach ($errors->get('expiry_date') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" name="discount" id="discount" step="any" class="form-control"
                        placeholder="Enter discount" required>
                    @if ($errors->has('discount'))
                        @foreach ($errors->get('discount') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="submit" value="Submit" class="btn btn-primary m-2">
                    <input type="reset" value="Reset" class="btn btn-primary m-2">
                </div>
            </fieldset>
        </form>
    </div>
@endsection
