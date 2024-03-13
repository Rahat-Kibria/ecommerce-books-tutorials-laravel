@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin >List of Customers</h3>
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
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->contact_number }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->username }}</td>
                        <td>{{ $customer->role }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.customer.view', $customer->id) }}">
                                <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                            </a>
                            <a href="{{ route('admin.customer.delete', $customer->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $customers->links() }}
@endsection
