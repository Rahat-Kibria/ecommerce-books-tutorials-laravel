@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > Edit Category</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <form action="{{ route('admin.category.update.submit', $category->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                <legend class="w-auto">Category Form</legend>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name*:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"
                        placeholder="Web Development" required>
                    @if ($errors->has('name'))
                        @foreach ($errors->get('name') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="parent_id" class="form-label">Subcategory of*:</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">No Subcategory</option>
                        @foreach ($categories as $cat)
                            <option @if ($category->parent_id == $cat->id) selected @endif value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="slug" name="slug" id="slug" class="form-control" value="{{ $category->slug }}"
                        required>
                    @if ($errors->has('slug'))
                        @foreach ($errors->get('slug') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control cleditor">{{ $category->description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" name="image" id="image" class="form-control"
                        accept="image/png, image/jpeg, image/jpg, image/gif" value="{{ $category->image }}">
                    @if ($errors->has('image'))
                        @foreach ($errors->get('image') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                    @if ($category->image != null)
                        <img src="{{ url('/uploads/category_images/' . $category->image) }}"
                            style="height:100px; width:100px; border-radius:5%" alt="Category Image">
                    @else
                        <img src="{{ url('/uploads/default/no_image.jpg') }}" style="height:100px; width:100px;"
                            alt="No Image">
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option @if ($category->status == 'Active') selected @endif value="Active">Active</option>
                        <option @if ($category->status == 'Inactive') selected @endif value="Inactive">Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                        @foreach ($errors->get('status') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="submit" value="Update" class="btn btn-primary m-2">
                    <input type="reset" value="Reset" class="btn btn-primary m-2">
                </div>
            </fieldset>
        </form>
        @if (!empty($category->image))
            <h5>Category Image Delete</h5>
            <form action="{{ route('admin.category.image.delete', [$category->id, $category->image]) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        @endif
    </div>
@endsection
