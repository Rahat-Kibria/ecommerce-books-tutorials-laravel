@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Products</h3>
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
                    <th scope="col" style="color: red;">Category Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Purchase</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Video</th>
                    <th scope="col">Discount</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key + $products->firstItem() }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->type }}</td>
                        <td>৳{{ $product->purchase_price }}</td>
                        <td>৳{{ $product->price }}</td>
                        @php
                            $productImage = json_decode($product->image);
                        @endphp
                        <td>
                            @if (!empty($productImage[0]))
                                <img src="{{ url('/uploads/product_images/' . $productImage[0]) }}"
                                    style="height:50px; width:50px; border-radius:50%" alt="Product Image">
                            @else
                                <img src="{{ url('/uploads/default/no_image.jpg') }}" height="50" width="50"
                                    alt="No Image">
                            @endif
                        </td>
                        <td>
                            @php
                                $productVideo = json_decode($product->video);
                            @endphp
                            @if (!empty($productVideo[0]))
                                <video height="50" width="65" controls>
                                    <source src="{{ url('/uploads/product_videos/' . $productVideo[0]) }}" type="video/mp4">
                                    This browser doesn't support video tag.
                                </video>
                            @else
                                <img src="{{ url('/uploads/default/no_video.png') }}" height="50" width="50"
                                    alt="No Video">
                            @endif
                        </td>
                        <td>{{ $product->discount }}%</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.product.view', [$product->id, $product->slug]) }}"
                                class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.product.edit', [$product->id, $product->slug]) }}"
                                class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@endsection
