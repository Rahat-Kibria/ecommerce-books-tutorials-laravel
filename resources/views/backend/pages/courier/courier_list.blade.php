@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Couriers</h3>
        <a href="{{ route('admin.courier.form') }}" class="float-end mt-2">
            <button type="button" class="btn btn-primary">Add Courier</button>
        </a>
    </div>
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">NID Number</th>
                    <th scope="col">Image</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courier as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->address }}</td>
                        <td>{{ $data->contact_number }}</td>
                        <td>{{ $data->nid_number }}</td>
                        <td>
                            <img src="{{ url('/uploads/' . $data->image) }}"
                                style="height:30px; width:30px; border-radius:50%" alt="Courier Image">
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ url('') }}">
                                <button type="button" class="btn btn-info">View</button>
                            </a>
                            <a href="{{ url('') }}">
                                <button type="button" class="btn btn-warning">Update</button>
                            </a>
                            <a href="{{ url('') }}">
                                <button type="button" class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $courier->links() }}
@endsection
