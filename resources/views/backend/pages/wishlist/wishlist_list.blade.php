@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Wishlists</h3>
    </div>
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="color: red;">Auth User ID</th>
                    <th scope="col" style="color: red;">Number of Products</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wishlists_by_user as $key => $wishlist)
                    @php
                        $wishlist_product_count = App\Models\Wishlist::where('user_id', $wishlist->user_id)->count();
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $wishlist->user_id }}</td>
                        <td>{{ $wishlist_product_count }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.wishlist.view', $wishlist->user_id) }}">
                                <button type="button" class="btn btn-info">View</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $wishlists_by_user->links() }}
@endsection
