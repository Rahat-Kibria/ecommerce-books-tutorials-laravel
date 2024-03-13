@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > Add a Product</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <form action="{{ route('admin.product.form.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                <legend class="w-auto">Product Form</legend>
                <div class="form-group mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <select name="category_id" id="category_name" class="form-control">
                        @foreach ($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control"
                        placeholder="Enter product name" required>
                    @if ($errors->has('name'))
                        @foreach ($errors->get('name') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="author" class="form-label">Author:</label>
                    <input type="text" name="author" id="author" class="form-control"
                        placeholder="Enter author/instructor name" required>
                    @if ($errors->has('author'))
                        @foreach ($errors->get('author') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug"
                        required>
                    @if ($errors->has('slug'))
                        @foreach ($errors->get('slug') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="ck_editor" class="form-label">Short Description:</label>
                    <textarea name="short_description" id="ck_editor" class="cleditor form-control"
                        placeholder="Enter a short description of the product"></textarea>
                    @if ($errors->has('short_description'))
                        @foreach ($errors->get('short_description') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="ck_editor1" class="form-label">Description:</label>
                    <textarea name="description" id="ck_editor1" class="form-control" placeholder="Enter the description of the product"></textarea>
                    @if ($errors->has('description'))
                        @foreach ($errors->get('description') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="Book" default>Book</option>
                        <option value="Tutorial">Tutorial</option>
                    </select>
                    @if ($errors->has('type'))
                        @foreach ($errors->get('type') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="purchase_price" class="form-label">Purchase Price:</label>
                    <input type="number" id="purchase_price" name="purchase_price" class="form-control" step=".01"
                        placeholder="Enter price" required>
                    @if ($errors->has('purchase_price'))
                        @foreach ($errors->get('purchase_price') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" id="price" name="price" class="form-control" step=".01"
                        placeholder="Enter price" required>
                    @if ($errors->has('price'))
                        @foreach ($errors->get('price') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Images:</label>
                    <div class="row">
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_1"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_1'))
                                @foreach ($errors->get('image_1') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_2"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_2'))
                                @foreach ($errors->get('image_2') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_3"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_3'))
                                @foreach ($errors->get('image_3') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_4"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_4'))
                                @foreach ($errors->get('image_4') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_5"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_5'))
                                @foreach ($errors->get('image_5') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_6"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_6'))
                                @foreach ($errors->get('image_6') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="image" name="image_7"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            @if ($errors->has('image_7'))
                                @foreach ($errors->get('image_7') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="video" class="form-label">Videos:</label>
                    <div class="row">
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_1" accept="video/mp4, video/flv">
                            @if ($errors->has('video_1'))
                                @foreach ($errors->get('video_1') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_2" accept="video/mp4, video/flv">
                            @if ($errors->has('video_2'))
                                @foreach ($errors->get('video_2') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_3" accept="video/mp4, video/flv">
                            @if ($errors->has('video_3'))
                                @foreach ($errors->get('video_3') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_4" accept="video/mp4, video/flv">
                            @if ($errors->has('video_4'))
                                @foreach ($errors->get('video_4') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_5" accept="video/mp4, video/flv">
                            @if ($errors->has('video_5'))
                                @foreach ($errors->get('video_5') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_6" accept="video/mp4, video/flv">
                            @if ($errors->has('video_6'))
                                @foreach ($errors->get('video_6') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-1" style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                            <input type="file" id="video" name="video_7" accept="video/mp4, video/flv">
                            @if ($errors->has('video_7'))
                                @foreach ($errors->get('video_7') as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" name="discount" id="discount" step="any" class="form-control"
                        placeholder="Enter discount" required>
                    @if ($errors->has('discount'))
                        @foreach ($errors->get('discount') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"
                        placeholder="Enter quantity" required>
                    @if ($errors->has('quantity'))
                        @foreach ($errors->get('quantity') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="stock_status" class="form-label">*Stock Status:</label>
                    <select name="stock_status" id="stock_status" class="form-control">
                        <option value="Available" default>Availabe</option>
                        <option value="Not Available">Not Available</option>
                    </select>
                    @if ($errors->has('stock_status'))
                        @foreach ($errors->get('stock_status') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="featured" class="form-label">*Featured Product?:</label>
                    <select name="featured" id="featured" class="form-control">
                        <option value="No" default>No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    @if ($errors->has('featured'))
                        @foreach ($errors->get('featured') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="submit" value="Submit" class="btn btn-primary m-2">
                    <input type="reset" value="Reset" class="btn btn-primary m-2">
                </div>
            </fieldset>
        </form>
    </div>
@endsection
