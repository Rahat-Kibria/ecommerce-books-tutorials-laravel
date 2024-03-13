@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Carts</h3>
    </div>
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User IP Address</th>
                    <th scope="col" style="color: red;">Number of Products</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @inject('carbon', 'Carbon\Carbon')
                @foreach ($carts as $key => $cart)
                    @php
                        //product count in cart using specific ip address
                        $cart_product_count = App\Models\Cart::where('ip_address', $cart->ip_address)->count();
                        //get all products from cart using ip address
                        $cart_products = App\Models\Cart::where('ip_address', $cart->ip_address)->get();
                        //days count
                        $created_at = $carbon::parse($cart_products->first()->created_at);
                        $now = $carbon::now();
                        $days_count = $created_at->diffInDays($now);
                        //status (expires in 3 days)
                        $status = $cart_products->first()->created_at->addDays(3) > $carbon::now();
                        // dd($status);
                    @endphp
                    <tr>
                        <td>{{ $key + $carts->firstItem() }}</td>
                        <td>{{ $cart->ip_address }}</td>
                        <td>{{ $cart_product_count }}</td>
                        <td>{{ $cart_products->first()->created_at }} ({{ $days_count }} days ago)</td>
                        <td>
                            @if ($status)
                                <span class="btn-sm btn-success" style="text-transform: uppercase;">Valid</span>
                            @else
                                <span class="btn-sm btn-danger" style="text-transform: uppercase;">Expired</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.cart.view.products', $cart->ip_address) }}">
                                <button type="button" class="btn btn-info">View</button>
                            </a>
                            <a href="{{ route('admin.cart.delete.on.expiry') }}">
                                <button type="button" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $carts->links() }}
@endsection
