@extends('frontend.pages.customer.customer_account')
@section('content_customer')
    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
        <div class="tab-content" id="myaccountContent">
            {{-- Single Tab Content Start --}}
            <div id="orders">
                <div class="myaccount-content">
                    <h3>My Orders</h3>
                    <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if ($order->is_cancelled == 'yes')
                                                Order is cancelled
                                            @elseif ($order->is_completed == 'yes')
                                                Order is completed
                                            @elseif ($order->is_out_for_delivery == 'yes')
                                                Order is out for delivery
                                            @elseif ($order->is_seen_by_admin == 'yes')
                                                Order is processing
                                            @else
                                                Order is confirmed
                                            @endif
                                        </td>
                                        <td>৳ {{ $order->grand_total }}</td>
                                        <td><a href="{{ route('botu.account.my_order.details', $order->id) }}"
                                                class="btn">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="alert alert-danger" style="width: 40%">No Orders here</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Single Tab Content End --}}
        </div>
    </div>
@endsection
