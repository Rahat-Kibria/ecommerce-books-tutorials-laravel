@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > Edit Post</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                <legend class="w-auto">Post Edit</legend>
                <div class="form-group mb-3">
                    <label for="user_name" class="form-label text-danger">User Name</label>
                    <select name="user_id" id="user_name" class="form-control">
                        @foreach ($users as $user)
                            <option @if ($post->user->id == $user->id) selected @endif value="{{ $user->id }}">
                                {{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        @foreach ($errors->get('user_id') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="category_name" class="form-label text-danger">Category Name</label>
                    <select name="category_id" id="category_name" class="form-control">
                        @foreach ($categories as $category)
                            <option @if ($post->category->id == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" style="color: red;">Tags:</label> <br>
                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}"
                            @foreach ($post->tags as $p_tag) @if ($tag->id == $p_tag->id) checked @endif @endforeach>
                        <label class="form-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                    @endforeach
                    @if ($errors->has('tags'))
                        @foreach ($errors->get('tags') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}"
                        placeholder="Enter post title" required>
                    @if ($errors->has('title'))
                        @foreach ($errors->get('title') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ $post->slug }}"
                        placeholder="Enter slug" required>
                    @if ($errors->has('slug'))
                        @foreach ($errors->get('slug') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Image:</label>
                    @if ($post->image != null)
                        <img src="{{ url('/uploads/blog_images/' . $post->image) }}" style="height:150px; width:230px;"
                            alt="Post Image">
                    @else
                        <img src="{{ url('/uploads/default/no_image.jpg') }}" style="height:30px; width:30px;"
                            alt="No Image">
                    @endif
                    <input type="file" name="image" class="form-control"
                        accept="image/png, image/jpeg, image/jpg, image/gif">
                    <input type="hidden" name="image" value="{{ $post->image }}">
                    @if ($errors->has('image'))
                        @foreach ($errors->get('image') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="ck_editor" class="form-label">Content:</label>
                    <textarea name="content" id="ck_editor" class="cleditor form-control" placeholder="Write content of the post">{{ $post->content }}</textarea>
                    @if ($errors->has('content'))
                        @foreach ($errors->get('content') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option @if ($post->status == 'draft') selected @endif value="draft">Draft</option>
                        <option @if ($post->status == 'completed') selected @endif value="completed">Completed</option>
                    </select>
                    @if ($errors->has('status'))
                        @foreach ($errors->get('status') as $error)
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
