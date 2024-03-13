@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Coupons</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $key => $coupon)
                    <tr>
                        <td>{{ $key + $coupons->firstItem() }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->expiry_date }}</td>
                        <td>{{ $coupon->discount }}%</td>
                        <td>
                            @if ($coupon->expiry_date >= Carbon\Carbon::now())
                                <span class="btn btn-sm rounded-pill btn-success">Valid</span>
                            @else
                                <span class="btn btn-sm rounded-pill btn-danger">Invalid</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.coupon.view', [$coupon->id, $coupon->slug]) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.coupon.edit', [$coupon->id, $coupon->slug]) }}"
                                class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('admin.coupon.delete', $coupon->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $coupons->links() }}
@endsection
