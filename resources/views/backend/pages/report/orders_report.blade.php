@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > Orders Report</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('admin.report.orders.search') }}" method="get">
        <div class="row" style="padding: 10px;">
            <div class="col-md-4">
                <label for="from_date" style="font-weight:bold;">From date:</label>
                <input name="from_date" type="date" class="form-control">
                @if ($errors->has('from_date'))
                    @foreach ($errors->get('from_date') as $error)
                        <small class="text-danger">{{ $error }}</small>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4">
                <label for="to_date" style="font-weight:bold;">To date:</label>
                <input name="to_date" type="date" class="form-control">
                @if ($errors->has('to_date'))
                    @foreach ($errors->get('to_date') as $error)
                        <small class="text-danger">{{ $error }}</small>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 pt-4">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
    </form>
    <div style="padding: 10px;" id="ordersReport">
        <div class="mt-3" style="width: 20%;">
            <h4 class="alert alert-success">Orders Report</h4>
        </div>
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Product Count</th>
                    <th scope="col">User Role</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    @php
                        $product_count = $order->orderDetails->count();
                        if (!empty($order->user)) {
                            $user_role = $order->user->role;
                        } else {
                            $user_role = null;
                        }
                    @endphp
                    <tr>
                        <td>{{ $key + $orders->firstItem() }}</td>
                        <td>
                            @if (!empty($order->user))
                                {{ $order->user->first_name }} {{ $order->user->last_name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($order->user))
                                {{ $order->user->email }}
                            @endif
                        </td>
                        <td>{{ $product_count }}</td>
                        <td>{{ $user_role }}</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
    <div style="width: 10%; padding: 10px;">
        <button class="btn btn-success" id="report_print_button">Print</button>
    </div>
@endsection
