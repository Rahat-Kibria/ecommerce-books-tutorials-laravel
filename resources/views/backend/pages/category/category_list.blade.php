@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Categories</h3>
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
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + $categories->firstItem() }}</td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if ($category->image != null)
                                <img src="{{ url('/uploads/category_images/' . $category->image) }}"
                                    style="height:30px; width:30px; border-radius:50%" alt="Category Image">
                            @else
                                <img src="{{ url('/uploads/default/no_image.jpg') }}" style="height:30px; width:30px;"
                                    alt="No Image">
                            @endif
                        </td>
                        <td>{{ $category->status }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.category.view', $category->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.category.update', $category->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('admin.category.delete', $category->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
@endsection
