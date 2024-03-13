@extends('backend.admin')
@section('content')
    <div class="row" style="padding: 0 10px 0 10px;">
        <div class="col-7 mt-3">
            <h4 class="alert alert-success" style="width: 60%;">User IP Address <span
                    class="text-danger">#{{ $ip_address }}</span></h4>
        </div>
    </div>
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="color: red;">Product(s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart_products as $key => $cart_product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $cart_product->product->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
