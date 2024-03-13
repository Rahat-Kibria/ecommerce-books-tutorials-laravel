@extends('backend.admin')
@section('content')
    <div class="row" style="padding: 0 10px 0 10px;">
        <div class="col-7 mt-3">
            <h4 class="alert alert-success" style="width: 40%;">Customer ID <span
                    class="text-danger">#{{ $customer->id }}</span></h4>
        </div>
    </div>
    <div style="padding: 10px;">
        <table class="table table-hover table-success">
            <thead>
                <tr>
                    <th colspan='2' style="font-size: 1.5rem; text-transform: uppercase;">Customer Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td style="text-align: right;">{{ $customer->first_name }} {{ $customer->last_name }}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td style="text-align: right;">{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td style="text-align: right;">{{ $customer->contact_number }}</td>
                </tr>
                <tr>
                    <th>Customer Address</th>
                    <td style="text-align: right;">{{ $customer->address }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td style="text-align: right;">{{ $customer->city }}</td>
                </tr>
                <tr>
                    <th>Post Code</th>
                    <td style="text-align: right;">{{ $customer->postal_code }}</td>
                </tr>
                <tr>
                    <th>Ccountry</th>
                    <td style="text-align: right;">{{ $customer->country }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
