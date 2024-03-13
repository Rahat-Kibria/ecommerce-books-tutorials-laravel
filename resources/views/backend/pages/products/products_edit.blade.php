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
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                <legend class="w-auto">Product Form</legend>
                <div class="form-group mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <select name="category_id" id="category_name" class="form-control">
                        @foreach ($category as $cat)
                            <option @if ($product->category_id == $cat->id) selected @endif value="{{ $cat->id }}">
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control"
                        placeholder="Teach Yourself Web Development" required>
                    @if ($errors->has('name'))
                        @foreach ($errors->get('name') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="author" class="form-label">Author:</label>
                    <input type="text" name="author" id="author" value="{{ $product->author }}" class="form-control"
                        placeholder="Abdullah ibn Masud" required>
                    @if ($errors->has('author'))
                        @foreach ($errors->get('author') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" name="slug" id="slug" value="{{ $product->slug }}" class="form-control">
                    @if ($errors->has('slug'))
                        @foreach ($errors->get('slug') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="ck_editor" class="form-label">Short Description:</label>
                    <textarea name="short_description" id="ck_editor" class="cleditor form-control">{{ $product->short_description }}</textarea>
                    @if ($errors->has('short_description'))
                        @foreach ($errors->get('short_description') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group
                    mb-3">
                    <label for="ck_editor1" class="form-label">Description:</label>
                    <textarea name="description" id="ck_editor1" class="cleditor form-control">{{ $product->description }}</textarea>
                    @if ($errors->has('description'))
                        @foreach ($errors->get('description') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-control">
                        <option @if ($product->type == 'Book') selected @endif value="Book" default>Book</option>
                        <option @if ($product->type == 'Tutorial') selected @endif value="Tutorial">Tutorial
                        </option>
                    </select>
                    @if ($errors->has('type'))
                        @foreach ($errors->get('type') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="purchase_price" class="form-label">Purchase Price:</label>
                    <input type="number" id="purchase_price" name="purchase_price" value="{{ $product->purchase_price }}"
                        class="form-control" step=".01" placeholder="Enter the purchase price by admin for product"
                        required>
                    @if ($errors->has('purchase_price'))
                        @foreach ($errors->get('purchase_price') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" id="price" name="price" value="{{ $product->price }}" class="form-control"
                        step=".01" placeholder="Enter the old price of the product" required>
                    @if ($errors->has('price'))
                        @foreach ($errors->get('price') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" name="discount" id="discount" step="any" class="form-control"
                        value="{{ $product->discount }}" placeholder="10%" required>
                    @if ($errors->has('discount'))
                        @foreach ($errors->get('discount') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}"
                        class="form-control" placeholder="3" required>
                    @if ($errors->has('quantity'))
                        @foreach ($errors->get('quantity') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="stock_status" class="form-label">Stock Status:</label>
                    <select name="stock_status" id="stock_status" class="form-control">
                        <option @if ($product->status == 'Available') selected @endif value="Available" default>Availabe
                        </option>
                        <option @if ($product->status == 'Not Available') selected @endif value="Not Availabe">Not Available
                        </option>
                    </select>
                    @if ($errors->has('stock_status'))
                        @foreach ($errors->get('stock_status') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="featured" class="form-label">Featured Product?:</label>
                    <select name="featured" id="featured" class="form-control">
                        <option @if ($product->featured == 'No') selected @endif value="No" default>No</option>
                        <option @if ($product->featured == 'Yes') selected @endif value="Yes">Yes
                        </option>
                    </select>
                    @if ($errors->has('featured'))
                        @foreach ($errors->get('featured') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="submit" value="Update Data" class="btn btn-warning m-2">
                </div>
            </fieldset>
        </form>
        <br>
        <hr>
        <div style="padding: 10px;">
            <form action="{{ route('admin.product.image.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <fieldset class="form-group border" style="background-color: #CEFAD0;">
                    <legend class="w-auto">Image Update Form</legend>
                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Images:</label>
                        <div class="row">
                            @php
                                $productImage = json_decode($product->image);
                            @endphp
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[0]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[0]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_1"
                                    @if (!empty($productImage[0])) value="{{ $productImage[0] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_1'))
                                    @foreach ($errors->get('image_1') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[0]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[0]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[1]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[1]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_2"
                                    @if (!empty($productImage[1])) value="{{ $productImage[1] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_2'))
                                    @foreach ($errors->get('image_2') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[1]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[1]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[2]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[2]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_3"
                                    @if (!empty($productImage[2])) value="{{ $productImage[2] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_3'))
                                    @foreach ($errors->get('image_3') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[2]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[2]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[3]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[3]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_4"
                                    @if (!empty($productImage[3])) value="{{ $productImage[3] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_4'))
                                    @foreach ($errors->get('image_4') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[3]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[3]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[4]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[4]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_5"
                                    @if (!empty($productImage[4])) value="{{ $productImage[4] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_5'))
                                    @foreach ($errors->get('image_5') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[4]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[4]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[5]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[5]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_6"
                                    @if (!empty($productImage[5])) value="{{ $productImage[5] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_6'))
                                    @foreach ($errors->get('image_6') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[5]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[5]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productImage[6]))
                                    <img src="{{ url('/uploads/product_images/' . $productImage[6]) }}" width="100"
                                        class="img-thumbnail" alt="Product Image">
                                @else
                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="100" width="100"
                                        alt="No Image">
                                @endif
                                <input type="file" id="image" name="image_7"
                                    @if (!empty($productImage[6])) value="{{ $productImage[6] }}" @endif
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                @if ($errors->has('image_7'))
                                    @foreach ($errors->get('image_7') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productImage[6]))
                                    <form
                                        action="{{ route('admin.product.image.delete', [$product->id, $productImage[6]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="submit" value="Update Image(s)" class="btn btn-warning m-2">
                    </div>
                </fieldset>
            </form>
            <br>
            <hr>
            <form action="{{ route('admin.product.video.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <fieldset class="form-group border" style="background-color: #CEFAD0;">
                    <legend class="w-auto">Video Update Form</legend>
                    <div class="form-group mb-3">
                        <label for="video" class="form-label">Video:</label>
                        <div class="row">
                            @php
                                $productVideo = json_decode($product->video);
                            @endphp
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[0]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[0]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_1"
                                    @if (!empty($productVideo[0])) value="{{ $productVideo[0] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_1'))
                                    @foreach ($errors->get('video_1') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[0]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[0]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[1]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[1]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_2"
                                    @if (!empty($productVideo[1])) value="{{ $productVideo[1] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_2'))
                                    @foreach ($errors->get('video_2') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[1]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[1]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[2]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[2]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_3"
                                    @if (!empty($productVideo[2])) value="{{ $productVideo[2] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_3'))
                                    @foreach ($errors->get('video_3') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[2]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[2]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[3]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[3]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_4"
                                    @if (!empty($productVideo[3])) value="{{ $productVideo[3] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_4'))
                                    @foreach ($errors->get('video_4') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[3]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[3]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[4]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[4]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_5"
                                    @if (!empty($productVideo[4])) value="{{ $productVideo[4] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_5'))
                                    @foreach ($errors->get('video_5') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[4]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[4]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[5]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[5]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_6"
                                    @if (!empty($productVideo[5])) value="{{ $productVideo[5] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_6'))
                                    @foreach ($errors->get('video_6') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[5]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[5]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div style="width: 14.28571%; flex: 0 0 14.28571%; max-width: 14.28571%;">
                                @if (!empty($productVideo[6]))
                                    <video height="100" width="130" controls>
                                        <source src="{{ url('/uploads/product_videos/' . $productVideo[6]) }}"
                                            type="video/mp4">
                                        This browser doesn't support video tag.
                                    </video>
                                @else
                                    <img src="{{ url('/uploads/default/no_video.png') }}" height="100" width="100"
                                        alt="No Video">
                                @endif
                                <input type="file" id="video" name="video_7"
                                    @if (!empty($productVideo[6])) value="{{ $productVideo[6] }}" @endif
                                    accept="video/mp4, video/flv">
                                @if ($errors->has('video_7'))
                                    @foreach ($errors->get('video_7') as $error)
                                        <small class="text-danger">{{ $error }}</small>
                                    @endforeach
                                @endif
                                @if (!empty($productVideo[6]))
                                    <form
                                        action="{{ route('admin.product.video.delete', [$product->id, $productVideo[6]]) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="submit" value="Update Video(s)" class="btn btn-warning m-2">
                    </div>
                </fieldset>
            </form>
        </div>
    @endsection
