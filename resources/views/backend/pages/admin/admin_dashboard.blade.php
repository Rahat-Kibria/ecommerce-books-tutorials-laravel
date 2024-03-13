@extends('backend.admin')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="mt-3" style="width: 35%;">
                <h3 class="alert alert-success">Admin > Dashboard</h3>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-4 text-center">
                        <div class="card-body" style="font-size: 2rem; font-weight: bold;">Total Customers</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="stretched-link" href="{{ route('admin.customers.list') }}"
                                style="text-decoration: none; font-size: 2rem; font-weight: bold; color: #62ab00;">{{ $customer_count }}
                                <i class="fa-solid fa-people-group"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-4 text-center">
                        <div class="card-body" style="font-size: 2rem; font-weight: bold;">Total Products</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="stretched-link" href="{{ route('admin.products.list') }}"
                                style="text-decoration: none; font-size: 2rem; font-weight: bold; color: #62ab00;">{{ $product_count }}
                                <i class="fa-sharp fa-solid fa-cubes"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-4 text-center">
                        <div class="card-body" style="font-size: 2rem; font-weight: bold;">Total Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="stretched-link" href="{{ route('admin.orders.list') }}"
                                style="text-decoration: none; font-size: 2rem; font-weight: bold; color: #62ab00;">{{ $order_count }}
                                <i class="fa-solid fa-bag-shopping"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">Orders Today</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="small stretched-link" href="{{ route('admin.orders.list') }}"
                                style="text-decoration: none; font-size: 2rem; font-weight: bold; color: #62ab00;">{{ $orders_today }}
                                <i class="fa-solid fa-bag-shopping"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">Products Sold</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="small stretched-link" href="{{ route('admin.orders.list') }}"
                                style="text-decoration: none; font-size: 2rem; font-weight: bold; color: #62ab00;"><i
                                    class="fa-sharp fa-solid fa-cubes"></i> {{ $products_sold }}
                                <i class="fa-solid fa-bag-shopping"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">Total Profit</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="small stretched-link" href="javascript:"
                                style="text-decoration: none; font-size: 2rem; font-weight: bold; color: #62ab00;">Future
                                Work <i class="fa-solid fa-coins"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">New Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-left">
                            <a class="small stretched-link" href="{{ route('admin.orders.list') }}"></a>
                            <table style="width: 100%; font-size: 1.3rem; color: #62ab00;" class="table text-center">
                                <tr>
                                    <th>Create At</th>
                                    <th>Product Count</th>
                                    <th>User Role</th>
                                </tr>
                                @forelse ($new_orders as $new_order)
                                    @php
                                        $product_count = $new_order->orderDetails->count();
                                        if (!empty($new_order->user->role)) {
                                            $user_role = $new_order->user->role;
                                        } else {
                                            $user_role = null;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $new_order->created_at }}</td>
                                        <td>{{ $product_count }}</td>
                                        <td>{{ $user_role }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">Sales Statistic</div>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <a class="small stretched-link" href="javascript:">Pie Chart Future work</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">Top Selling
                                Products</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="{{ route('admin.orders.list') }} "></a>
                                <table style="width: 100%; font-size: 1.3rem; color: #62ab00;" class="table text-center">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Sold (times)</th>
                                    </tr>
                                    @forelse ($top_product_sales_count as $product_count)
                                        <tr>
                                            <td>{{ $product_count->product->name }}</td>
                                            <td>{{ $product_count->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body text-center" style="font-size: 2rem; font-weight: bold;">Subscriptions
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="{{ route('admin.subscription.emails') }}"></a>
                                <table style="width: 100%; font-size: 1.3rem; color: #62ab00;" class="table text-center">
                                    <tr>
                                        <th>Emails</th>
                                    </tr>
                                    @forelse ($subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $subscription->email }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>{{ $subscription->email }}</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
