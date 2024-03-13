@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin >List of Feedbacks</h3>
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
                    <th scope="col" style="color: red;">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $key => $feedback)
                    <tr>
                        <td>{{ $key + $feedbacks->firstItem() }}</td>
                        <td>{{ $feedback->user_id }}</td>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>
                            <p style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $feedback->message }}</p>
                        </td>
                        <td>
                            <p class="badge @if ($feedback->status == 'pending') bg-danger @elseif ($feedback->status == 'seen') bg-warning @else bg-success @endif"
                                style="text-transform: uppercase;">
                                {{ $feedback->status }}
                            </p>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.feedback.view', $feedback->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.feedback.edit', $feedback->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('admin.feedback.delete', $feedback->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $feedbacks->links() }}
@endsection
