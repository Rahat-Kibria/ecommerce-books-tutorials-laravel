@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 50%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Subscription Emails</h3>
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
                    <th scope="col">Email</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $key => $subscription)
                    <tr>
                        <td>{{ $key + $subscriptions->firstItem() }}</td>
                        <td>{{ $subscription->email }}</td>
                        <td style="text-align: center;">
                            <a href="javascript:" class="btn btn-info">
                                Future Work
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $subscriptions->links() }}
@endsection
