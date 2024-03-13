@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Reviews</h3>
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
                    <th scope="col" style="color: red;">Product Name</th>
                    <th scope="col" style="color: red;">User Name</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_reviews as $key => $product_review)
                    <tr>
                        <td>{{ $key + $product_reviews->firstItem() }}</td>
                        <td>{{ $product_review->product->name }}</td>
                        <td>
                            @if (!empty($product_review->user))
                                {{ $product_review->user->first_name }} {{ $product_review->user->last_name }}
                            @endif
                        </td>
                        <td>{{ $product_review->rating }}</td>
                        <td>
                            <p style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $product_review->message }}</p>
                        </td>
                        <td>
                            @if ($product_review->status == 'pending')
                                <span class="btn-sm btn-warning"
                                    style="text-transform: capitalize;">{{ $product_review->status }}</span>
                            @else
                                <span class="btn-sm btn-success"
                                    style="text-transform: capitalize;">{{ $product_review->status }}</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.review.view', $product_review->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.review.edit', $product_review->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('admin.review.delete', $product_review->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $product_reviews->links() }}
@endsection
